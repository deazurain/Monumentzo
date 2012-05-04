package org.Monumentzo.LIReIndexer;

import java.io.File;
import java.net.URL;
import java.sql.SQLException;

import net.semanticmetadata.lire.DocumentBuilderFactory;

public class LireIndexer {

	private static IndexCreator indexCreator = null;
	private static DatabaseWriter dbWriter = null;
	
	public static final String host = "localhost";
	public static final String username = "root";
	public static final String password = "aardbei";
	public static final String database = "monumentzo";
	
	public static void main(String[] args) {
		String sourceDirectory = "";
		String indexDirectory = "";
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length - 1; i++) {
			switch(args[i]) {
			case "-i":
			case "-index":
				indexDirectory = args[i + 1];
				break;
			
			case "-s":
			case "-source":
				sourceDirectory = args[i + 1];
				break;
			}
		}
		
		// Create a indexCreator so that the information from the images can be indexed
		IndexCreator indexCreator = new IndexCreator();
		try {
			indexCreator.setIndexPath(new File(indexDirectory))
						.withDocumentBuilder(DocumentBuilderFactory.getEdgeHistogramBuilder());
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		// Index the images with the indexCreator
		LireIndexer.withIndexCreator(indexCreator);
		LireIndexer.readImageDirectory(new File(sourceDirectory));
		
		// Create database writer
		DatabaseWriter writer = null;
		try {
			writer = new DatabaseWriter(new URL(host), database, username, password);
		} catch (SQLException e) {
			e.printStackTrace();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		// Write the information to the database
		LireIndexer.withDatabaseWriter(writer);
		LireIndexer.writeIndexToDatabase();
	}
	
	public static void withIndexCreator(IndexCreator creator) {
		LireIndexer.indexCreator = creator;
	}
	
	public static void withDatabaseWriter(DatabaseWriter writer) {
		LireIndexer.dbWriter = writer;
	}
	
	public static void readImageDirectory(File directory) {
		try {
			String pattern = ".jpg";
			File listFile[] = directory.listFiles();
			
			for (int i = 0; i < listFile.length; i++) {
				if (listFile[i].isDirectory()) {
					// directory found -> enter directory in a recursive fashion
					readImageDirectory(listFile[i]);
				} else {
					if (listFile[i].getName().endsWith(pattern)) {
						// image found -> index
						indexCreator.indexImage(listFile[i]);
					}
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	public static void writeIndexToDatabase() {
		
	}
}
