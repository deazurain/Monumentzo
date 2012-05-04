package org.monumentzo.lire;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;

import javax.imageio.ImageIO;

import net.semanticmetadata.lire.ImageSearchHits;
import net.semanticmetadata.lire.ImageSearcher;
import net.semanticmetadata.lire.ImageSearcherFactory;

import org.apache.lucene.index.IndexReader;
import org.apache.lucene.store.FSDirectory;


public class LireImageMatcher {

	private File indexDirectory;
	private IndexReader reader;
	private ImageSearcher searcher;
	
	public LireImageMatcher(String indexDirectory) throws IOException {
		this.indexDirectory = new File(indexDirectory).getCanonicalFile();
	}
	
	public ImageSearchHits match(String imagePath, int limit) throws Exception {
		
		File imageFile = new File(imagePath).getCanonicalFile();
		
		reader = IndexReader.open(FSDirectory.open(indexDirectory));
		
		// the 'searcher' object indicates which features should be used for image comparison
		// play around with the createXXX methods to compare search results
		searcher = ImageSearcherFactory.createEdgeHistogramImageSearcher(limit);
		
		FileInputStream imageStream = new FileInputStream(imageFile);
		BufferedImage bimg = ImageIO.read(imageStream);
		
		ImageSearchHits hits = searcher.search(bimg, reader);
		
		reader.close();
		
		return hits;
	}
	
}
