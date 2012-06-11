package org.Monumentzo.RijksmonumtenScraper;

import java.io.StringReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Node;
import org.w3c.dom.Document;
import org.xml.sax.InputSource;

public class ResponseParser {

	public static ArrayList<Monument> parseResponse(String response) {
		
		ArrayList<Monument> monuments = new ArrayList<Monument>();
		
		try {
			// Build a XML document representation of the response string
			DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
			DocumentBuilder builder = factory.newDocumentBuilder();
			Document document = builder.parse(new InputSource(new StringReader(response)));
			
			// Get the results
			Node results = document.getElementsByTagName("result").item(0);
			Node doc = results.getFirstChild();
			
			// Extract all the necessary information from the response
			while(doc != null) {
				
				Monument monument = extractMonumentData(doc);
				monuments.add(monument);
				
				// Go the next result
				doc = doc.getNextSibling();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return monuments;
	}
	
	private static Monument extractMonumentData(Node doc) throws MalformedURLException {
		Node child = doc.getFirstChild();
		
		int id = 0;
		String name = null;
		String descr = null;
		String cat = null;
		
		float lat = Float.MAX_VALUE;
		float lon = Float.MAX_VALUE;
		
		String city = null;
		String province = null;
		String street = null;
		String streetNumber = null;
		
		String foundationDate = null;
		int foundationYear = 0;
		
		String wikiArticle = null;
		String wikiImage = null;	// Needed to get the link to the image
		URL wikiImageUrl = null;
		
		while(child != null) {
			
			switch(child.getAttributes().item(0).getNodeValue()) {
			case "rce_obj_nummer":		// MonumentID
				id = Integer.parseInt(child.getFirstChild().getNodeValue());
				break;
				
			case "abc_objectnaam":			// Monument name
				name = child.getFirstChild().getNodeValue();
				break;
				
			case "cit_tekst":			// Description
				if(descr == null || descr.isEmpty())
					descr = child.getFirstChild().getFirstChild().getNodeValue();
				break;
				
			case "rce_omschrijving_internationaal":		// Alternative description
				if(descr == null || descr.isEmpty())
					descr = child.getFirstChild().getNodeValue();
				break;
				
			case "rce_categorie":		// Monument category
				cat = child.getFirstChild().getNodeValue();
				break;
				
			case "abc_lat":				// Latitude
				lat = Float.parseFloat(child.getFirstChild().getNodeValue());
				break;
				
			case "abc_lon":				// Longitude
				lon = Float.parseFloat(child.getFirstChild().getNodeValue());
				break;
				
			case "abc_plaats":			// City
				city = child.getFirstChild().getNodeValue();
				break;
				
			case "rce_provincie":		// Province
				province = child.getFirstChild().getNodeValue();
				break;
				
			case "rce_straat":			// Street
				street = child.getFirstChild().getNodeValue();
				break;
				
			case "rce_huisnummer":		// streetNumber
				streetNumber = child.getFirstChild().getNodeValue();
				break;
				
			case "rce_bouwjaar_van":	// foundation year
				if(! child.hasChildNodes()) break;
				
				foundationYear = Integer.parseInt(child.getFirstChild().getNodeValue());
			case "rce_bouwjaar_tot":	// foundation date
			case "rce_bouwjaar_ind":
			case "rce_bouwjaar_tekst":
			case "wiki_bouwjaar":
				if(! child.hasChildNodes()) break;
				
				if(foundationDate != null) {
					foundationDate += ";" + child.getFirstChild().getNodeValue();
				}
				else {
					foundationDate = child.getFirstChild().getNodeValue();
				}
				break;
				
			case "wiki_article":		// Wiki article
				Node wikiArticleChild = child.getFirstChild();
				if(wikiArticleChild != null)
					wikiArticle = wikiArticleChild.getNodeValue();
				break;
				
			case "wiki_image":
				Node imageChild = child.getFirstChild();
				if(imageChild != null)
					wikiImage = imageChild.getNodeValue().replaceAll(" ", "_");
				break;
				
			case "wiki_image_url":
				if(wikiImage != null) {
					String temp = child.getFirstChild().getNodeValue().replaceAll("/thumb", "");
					temp = temp.replaceAll(wikiImage + "/800px-" + wikiImage, wikiImage);
					wikiImageUrl = new URL(temp);
				}
				break;
			}
			
			child = child.getNextSibling();
		}
		
		/* try to get some info from the foundation date */
		
		if(foundationDate != null && foundationYear == 0) {
			foundationYear = getYear(foundationDate);
		}
		
		return new Monument(id, name, descr, cat,
							lat, lon,
							city, province, street, streetNumber,
							foundationDate, foundationYear,
							wikiArticle, wikiImageUrl);
	}
	
	private static int getYear(String date) {
    	int year1 = 0;
    	int year2 = 0;
    	
    	Matcher year4m = Pattern.compile("\\d{4}").matcher(date);
    	Matcher year2m = Pattern.compile("'\\d{2}").matcher(date);
    	Matcher cent2m = Pattern.compile("\\d{2}e").matcher(date);
    	
    	if(year4m.find()) {
    		// 1234
    		year1 = Integer.parseInt(year4m.group());
    		
    		if(year4m.find()) {
    			// 1234 xxx 4312
    			year2 = Integer.parseInt(year4m.group());
    		}
    		else if(year2m.find()) {
    			// 1234-'54
    			int c = ((int)(year1/100))*100;
    			year2 = Integer.parseInt(year2m.group().substring(1, 3)) + c;
    		}
    	}
    	else if(cent2m.find()) {
    		// 14e 
    		year1 = Integer.parseInt(cent2m.group().substring(0, 2)) * 100;
    		
    		if(cent2m.find()) {
    			// 14e - 15e
    			year2 = Integer.parseInt(cent2m.group().substring(0, 2)) * 100;
    		}
    	}
    	
    	int year = (year2 != 0) ? year2 : year1;
    	
    	return year;
    }
}
