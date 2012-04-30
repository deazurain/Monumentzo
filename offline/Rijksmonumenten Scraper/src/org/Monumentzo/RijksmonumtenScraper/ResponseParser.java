package org.Monumentzo.RijksmonumtenScraper;

import java.io.StringReader;
import java.util.ArrayList;

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
	
	private static Monument extractMonumentData(Node doc) {
		Node child = doc.getFirstChild();
		
		int id = 0;
		String name = null;
		String descr = null;
		float lat = 0.0f;
		float lon = 0.0f;
		String city = null;
		String province = null;
		String street = null;
		String streetNumber = null;
		String foundationDate = null;
		int foundationYear = 0;
		String wikiArticle = null;
		
		while(child != null) {
			
			switch(child.getAttributes().item(0).getNodeValue()) {
			case "rce_obj_nummer":		// MonumentID
				id = Integer.parseInt(child.getFirstChild().getNodeValue());
				break;
				
			case "abc_objectnaam":			// Monument name
				name = child.getFirstChild().getNodeValue();
				break;
				
			case "cit_tekst":			// Description
				descr = child.getFirstChild().getFirstChild().getNodeValue();
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
				
			// TO DO: Not able to find this in the api 
			/*case "":					// foundationDate
				break;
				
			case "":					// foundationYear
				break;*/
				
			case "wiki_article":		// Wiki article
				Node wikiArticleChild = child.getFirstChild();
				if(wikiArticleChild != null)
					wikiArticle = wikiArticleChild.getNodeValue();
				break;
			}
			
			child = child.getNextSibling();
		}
		
		return new Monument(id, name, descr,
							lat, lon,
							city, province, street, streetNumber,
							foundationDate, foundationYear,
							wikiArticle);
	}
}
