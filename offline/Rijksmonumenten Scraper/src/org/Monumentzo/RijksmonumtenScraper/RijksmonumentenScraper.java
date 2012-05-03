package org.Monumentzo.RijksmonumtenScraper;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

public class RijksmonumentenScraper {
	
	public static void main(String[] args) {
		String sourceFile = null;
		String outputFolder = null;
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length - 1; i++) {
			switch(args[i]) {			
			case "-s":
			case "-source":
				sourceFile = args[i + 1];
				break;
				
			case "-o":
			case "-output":
				outputFolder = args[i + 1];
				break;
			}
		}
		
		// Output some information about the current program state
		System.out.println("Starting to download...");
		
		ArrayList<Monument> monuments = new ArrayList<Monument>(100);
		try {
			// Read the file containing the numbers of the monuments
			BufferedReader reader = new BufferedReader(new FileReader(new File(sourceFile)));
			
			String line = "";
			
			// For each monument get the information from api.rijksmonumenten.info
			while((line = reader.readLine()) != null) {
				String response = RijksmonumentenScraper.requestRijksmonumentenAPI(Integer.parseInt(line));
				monuments.addAll(ResponseParser.parseResponse(response));
			}
			reader.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
		
		// Give the user some more information
		System.out.println("Downloading done\n");
		
		// Create a database writer to write monument information to the database
		DatabaseWriter dbWriter = null;
		try {
			// dbWriter = new DatabaseWriter(databaseURL, Database, user, password);
			dbWriter = new DatabaseWriter("jdbc:mysql://localhost:3306/", "Monumentzo", "root", "M0NUM3NTz0");
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		System.out.println("Starting to download imgas and write information to the database...");
		
		// Write each and every monument to the database
		// and download the images corresponding with the monuments
		for(Monument monument : monuments) {
			
			System.out.println("Downloading the image for monument " + monument.getMonumentID());
			
			File image = new File(outputFolder, monument.getMonumentID() + ".jpg");
			ImageScraper.downloadImage(image, monument.getWikiImageURL());
			monument.setImagePath(image);
			
			dbWriter.StoreMonument(monument);
		}
		
		System.out.println("Downloaded the images");
		System.out.println("Completed the writing of the information to the database");
	}
	
	public static String requestRijksmonumentenAPI(int monumentNummer) throws IOException {
		
		// Give the user some information
		System.out.println("Downloading information about " + monumentNummer);
		
		// Create query string
		String queryString = "?q=rce_obj_nummer:" + monumentNummer;

		// URL for rijksmonumenten api: http://api.rijksmonumenten.info/select/?q=rce_obj_nummer:NUMMER_VAN_MONUMENT
		URL url = null;
		URLConnection urlConnection = null;
		try {
			// Make connection
			url = new URL("http://api.rijksmonumenten.info/select/" + queryString);
			urlConnection = url.openConnection();
		} catch (MalformedURLException e) {
			e.printStackTrace();
		}

		// Read the response
		BufferedReader in = new BufferedReader(new InputStreamReader(urlConnection.getInputStream()));
		
		String line = null;
		String response = "";
		while ((line = in.readLine()) != null) {
			response += line;
		}
		in.close();
		
		return response;
	}
}
