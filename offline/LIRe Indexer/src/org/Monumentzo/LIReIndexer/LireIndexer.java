package org.Monumentzo.LIReIndexer;

import java.io.File;

import net.semanticmetadata.lire.DocumentBuilderFactory;

public class LireIndexer {

	private static IndexCreator indexCreator = null;
	
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
	}
	
	public static void withIndexCreator(IndexCreator creator) {
		LireIndexer.indexCreator = creator;
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
}
