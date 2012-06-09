package org.Monumentzo.StopwordFilterer;

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;

public class Program {
	
	public static void main(String[] args) {
		
		String host = null;
		String database = null;
		String user = null;
		String password = null;
		String stopwordListFile = null;
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length - 1; i++) {
			switch(args[i]) {
			case "-s":
				stopwordListFile = args[i + 1];
				break;
			
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
		
		try {
			// Read the words from the file
			FileInputStream fstream = new FileInputStream(stopwordListFile);
	
			// Get the object of DataInputStream
			DataInputStream in = new DataInputStream(fstream);
			BufferedReader br = new BufferedReader(new InputStreamReader(in));
			
			System.out.println("Reading the word list...");
			
			//Read File Line By Line
			String word;
			Set<String> wordList = new HashSet<String>();
			while ((word = br.readLine()) != null)   {
				wordList.add(word);
			}
			
			System.out.println("Done reading the wordlist!");
			
			// If the word list is empty there is no reason to continue
			if(wordList.size() <= 0)
				return;
			
			DatabaseUpdater updater = new DatabaseUpdater(host, database, user, password);
			
			// Iterate over the words and remove them from the database
			Iterator<String> itr = wordList.iterator();
			while(itr.hasNext()) {
				word = itr.next();
				
				System.out.println("Removing '" + word + "' from the tags...");
				updater.UpdateDatabase(word);
			}
			
			System.out.println("Done removing tags!!!");
			
			// Close the input stream
			in.close();
		
		} catch (Exception e) {
			System.err.println("Error: " + e.getMessage());
		}
	}
}