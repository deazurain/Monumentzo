package org.Monumentzo.LIReIndexer;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

import net.semanticmetadata.lire.DocumentBuilderFactory;

public class LireIndexer {

	private static IndexCreator indexCreator = null;
	private static DatabaseWriter dbWriter = null;
	
	public static final String host = "jdbc:mysql://localhost/";
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
		LireIndexer.createImageIndex(new File(sourceDirectory));
		LireIndexer.indexCreator.close();
		
		/*
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
		*/
	}
	
	public static void withIndexCreator(IndexCreator creator) {
		LireIndexer.indexCreator = creator;
	}
	
	public static void withDatabaseWriter(DatabaseWriter writer) {
		LireIndexer.dbWriter = writer;
	}
	
	
	
	public static void createImageIndex(File directory) {

		List<File> imageFiles = findImageFiles(directory);
		
		for(int i = 0; i < imageFiles.size(); i++) {
			File imageFile = imageFiles.get(i);
			System.out.println("Indexing " + (i + 1) + "/" + imageFiles.size() + "\t" + imageFile.getAbsolutePath());
			indexCreator.indexImage(imageFile);
		}
		
	}
	
	public static List<File> findImageFiles(File directory) {
		List<File> imageFiles = new ArrayList<File>();
		findImageFiles(directory, imageFiles);
		return imageFiles;
	}
	
	private static void findImageFiles(File directory, List<File> imageFiles) {
		
		try {
			String extension = ".jpg";
			File listFile[] = directory.listFiles();
			
			for (int i = 0; i < listFile.length; i++) {
				if (listFile[i].isDirectory()) {
					// directory found -> enter directory in a recursive fashion
					findImageFiles(listFile[i], imageFiles);
				} else {
					if (listFile[i].getName().endsWith(extension)) {
						// image found -> index
						imageFiles.add(listFile[i]);
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
