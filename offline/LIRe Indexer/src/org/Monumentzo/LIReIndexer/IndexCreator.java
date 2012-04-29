package org.Monumentzo.LIReIndexer;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;

import org.apache.lucene.analysis.SimpleAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.index.CorruptIndexException;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.store.FSDirectory;
import org.apache.lucene.store.LockObtainFailedException;

import net.semanticmetadata.lire.DocumentBuilder;

public class IndexCreator {
	
	private DocumentBuilder builder = null;
	private IndexWriter indexWriter = null;
	
	@SuppressWarnings("deprecation")
	public IndexCreator setIndexPath(File path) throws CorruptIndexException, LockObtainFailedException, IOException {
		this.indexWriter = new IndexWriter(FSDirectory.open(path), new SimpleAnalyzer(), true, 
										   IndexWriter.MaxFieldLength.UNLIMITED);		
		return this;
	}
	
	public IndexCreator withDocumentBuilder(DocumentBuilder builder) {
		this.builder = builder;
		return this;
	}
	
	public void indexImage(File file) {
		if(this.builder == null)
			throw new NullPointerException("Cannot build a lucence document, because the builder is nonexistent.");
		
		if(this.indexWriter == null)
			throw new NullPointerException("Cannot write to the index, because the index writer is nonexistent.");
		
		try {
			// Build the Lucene document
			// based on the 'builder' type, visual features like edges, colors etc. are automatically extracted and stored in a document
			// documents are the representation for Lucene to store data; it can either be an image, textual data etc.
			// In our case, each document has one field for each visual feature and one additional field for the image name
			Document doc = builder.createDocument(new FileInputStream(
					file.getAbsolutePath()), file.getName().substring(0, file.getName().length()-4));
			
			// Add the document to the index
			indexWriter.addDocument(doc);
			
			System.out.println("indexed " + file.getAbsolutePath());
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
