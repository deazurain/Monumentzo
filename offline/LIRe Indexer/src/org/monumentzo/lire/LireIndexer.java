package org.monumentzo.lire;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import net.semanticmetadata.lire.DocumentBuilder;
import net.semanticmetadata.lire.DocumentBuilderFactory;

import org.apache.lucene.analysis.SimpleAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.store.FSDirectory;

public class LireIndexer {
	
	private File imagePath;
	private File indexPath;
	private IndexWriter iw;
	private DocumentBuilder builder;
	
	public LireIndexer(String imagePath, String indexPath) throws IOException {
		this.imagePath = new File(imagePath).getCanonicalFile();
		this.indexPath = new File(indexPath).getCanonicalFile();
	}
	
	@SuppressWarnings("deprecation")
	public void index() throws Exception {
		if(!imagePath.isDirectory()) {
			throw new Exception("Provided image path is not a directory: \"" + imagePath + "\"");
		}
		
		if(!indexPath.isDirectory()) {
			throw new Exception("Provided index path is not a directory: \"" + indexPath + "\"");
		}
		
		builder = DocumentBuilderFactory.getEdgeHistogramBuilder();
		
		iw = new IndexWriter(FSDirectory.open(indexPath), 
				new SimpleAnalyzer(), true, IndexWriter.MaxFieldLength.UNLIMITED);
		
		
		String extension = ".jpg";
		
		/* Find Images */
		
		System.out.println("Finding " + extension + " images...");
		
		long start = System.currentTimeMillis();
		List<File> imageFiles = findImageFiles(imagePath, extension);
		long end = System.currentTimeMillis();
		
		System.out.println("Found " + imageFiles.size() + " images in " + (end-start)/1000 + " seconds.");
		
		
		/* Index Images */
		
		System.out.println("Starting to index images...");
				
		start = System.currentTimeMillis();
		for(int i = 0; i < imageFiles.size(); i++) {
			File imageFile = imageFiles.get(i);
			
			System.out.println("Indexing " + (i + 1) + "/" + imageFiles.size() + "\t" + 
					imageFile.getAbsolutePath());
			
			indexImage(imageFile, extension);
		}
		end = System.currentTimeMillis();
		
		System.out.println("Finished indexing images in " + (end-start)/1000 + " seconds.");
		
		
		/* Optimize Index */
		
		System.out.println("Attempting to optimize index...");

		start = System.currentTimeMillis();
		iw.optimize();
		iw.close();
		end = System.currentTimeMillis();
		
		System.out.println("Finished optimizing index in " + (end-start)/1000 + " seconds.");
	}
	
	/**
	 * Attempts to recursively find files with a certain extension. 
	 * @param directory The directory to start searching in. 
	 * @param extension The file extension. 
	 * @return The list of all the files that were found with the provided
	 * extension
	 */
	private List<File> findImageFiles(File directory, String extension) {
		List<File> imageFiles = new ArrayList<File>();
		findImageFiles(directory, extension, imageFiles);
		return imageFiles;
	}
	
	/**
	 * Recursive function that descends in all its child directories in order
	 * to find files with a certain extension. 
	 * @param directory
	 * @param extension
	 * @param imageFiles
	 */
	private void findImageFiles(File directory, String extension, List<File> imageFiles) {
		
		File files[] = directory.listFiles();
		
		for (int i = 0; i < files.length; i++) {
			
			if (files[i].isDirectory()) {
				// directory found -> enter directory in a recursive fashion
				findImageFiles(files[i], extension, imageFiles);
			}
			else if (files[i].getName().endsWith(extension)) {
				// image found -> index
				imageFiles.add(files[i]);
			}
		}
	}
	
	/**
	 * Tries to index an image in a lucene document. 
	 * 
	 * @param imageFile
	 * @param extension
	 */
	private void indexImage(File imageFile, String extension) {
		
		try {
			// Build the Lucene document
			// based on the 'builder' type, visual features like edges, colors etc. are automatically extracted and stored in a document
			// documents are the representation for Lucene to store data; it can either be an image, textual data etc.
			// In our case, each document has one field for each visual feature and one additional field for the image name
			String imageName = imageFile.getName();
			imageName = imageName.substring(0, imageName.length() - extension.length());
			
			Document doc = builder.createDocument(new FileInputStream(imageFile.getAbsolutePath()), imageName);
			// Add the document to the index
			iw.addDocument(doc);
						
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
