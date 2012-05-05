package org.Monumentzo.Tagger;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.Set;

public class Tagger {

	public static void main(String[] args) {
		
		String host = null;
		String database = null;
		String user = null;
		String password = null;
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length - 1; i++) {
			switch(args[i]) {
			case "-db":
			case "-database":
				database = args[i + 1];
				break;
				
			case "-u":
			case "-user":
				user = args[i + 1];
				break;
				
			case "-h":
			case "-host":
				host = args[i + 1];
				break;
				
			case "-p":
			case "-password":
				password = args[i + 1];
				break;
			}
		}

		ArrayList<Monument> monumentData = null;
		try {
			DatabaseReader reader = new DatabaseReader(host, database, user, password);
			
			// Get the data of each monument
			monumentData = reader.getMonumentData();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		// If we could get the data we can't continue
		if(monumentData == null) {
			System.out.println("Could not get the information about the monuments");
			return;
		}
		
		// Extract all the words
		TagDataExtractor extractor = new TagDataExtractor(monumentData);
		extractor.extractWordCounts();
		
		// Get the extracted words
		Set<String> words = extractor.getWords();
		
		// Write everything to the database
		DatabaseWriter writer = null;
		try {
			writer = new DatabaseWriter(host, database, user, password);			
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		// Iterate over the words to calculate the tf * idf and write the information to the database
		Iterator<String> iterator = words.iterator();
		while(iterator.hasNext()) {
			String word = iterator.next();
			
			double idf = extractor.calculateInverseDocumentFrequency(word);
			if(idf < 0)
				continue;
			
			int tagID = writer.writeIdfInformation(word, idf);
			
			for(Monument monument : monumentData) {
				double tf = extractor.calculateTermFrequency(monument.getMonumentID(), word);
				if(tf < 0)
					continue;
				
				double tfIdf = tf * idf;
				writer.writeTfIdfInformation(monument.getMonumentID(), tagID, tf, tfIdf);
			}
		}
		
		// Vectorize each monument and put it in the database
		for(Monument monument : monumentData) {
			String vector = MonumentVectorizer.Vectorize(monument);
			writer.writeMonumentVector(monument.getMonumentID(), vector);
		}
	}
}
