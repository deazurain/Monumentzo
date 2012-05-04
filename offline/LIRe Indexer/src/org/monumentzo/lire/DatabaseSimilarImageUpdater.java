package org.monumentzo.lire;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.List;

import org.apache.lucene.document.Document;

import net.semanticmetadata.lire.DocumentBuilder;
import net.semanticmetadata.lire.ImageSearchHits;

public class DatabaseSimilarImageUpdater {

	private DatabaseWriter w;
	private LireImageMatcher lim;
	
	private long startTime = 0;
	private long endTime = 0;
	
	public DatabaseSimilarImageUpdater(DatabaseWriter databaseWriter) {
		this.w = databaseWriter;
	}
	
	public void performUpdate(String imageDirectory, String indexDirectory) {
		// for every image
			// find similar images
			// for every similar image
				// store similarity in database
		
		recordStart("Obtaining all images from database...");
		List<DatabaseImage> images = w.getAllImages();
		recordEnd("Retrieved " + images.size() + " images from the database");
		
		recordStart("Clearing SimilarImage table...");
		w.clearSimilarImageTable();
		recordEnd("Removed all data from SimilarImage table");
		
		try {
			lim = new LireImageMatcher(indexDirectory);
			
			for(DatabaseImage image : images) {
				recordStart("Finding similar images for image " + image.imageID + "...");
				File queryImageFile = new File(imageDirectory, image.monumentID + ".jpg");
				
				ImageSearchHits results;
				try {
					results = lim.match(queryImageFile.toString(), 10);
				}
				catch(FileNotFoundException e) {
					continue;
				}
				
				int foundCount = 0;
				for(int i = 0; i < results.length(); i++) {
					
					Document d = results.doc(i);
					@SuppressWarnings("deprecation")
					String name = d.getField(DocumentBuilder.FIELD_NAME_IDENTIFIER).stringValue();
					float score = results.score(i);
					if(score > 0.1) {
						foundCount++;
						DatabaseImage dbimage = w.getImageByMonumentID(Integer.parseInt(name));
						if(image.imageID != dbimage.imageID) { 
							w.addSimilarImage(image.imageID, dbimage.imageID, score);
						}
					}
				}
				recordEnd("Found " + foundCount + " similar images");
			}
			
		} catch (Exception e) {
			e.printStackTrace();
			return;
		}
		
	}
	
	private void recordStart(String message) {
		System.out.println(message);
		startTime = System.currentTimeMillis();
	}
	
	private void recordEnd(String message) {
		endTime = System.currentTimeMillis();
		long delta = (endTime - startTime);
		String time = (delta < 1000) ? (delta + " miliseconds.") : (delta/1000 + " seconds.");
		System.out.println(message + " in " + time);
	}
}
