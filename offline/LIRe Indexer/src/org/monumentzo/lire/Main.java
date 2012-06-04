package org.monumentzo.lire;

import net.semanticmetadata.lire.DocumentBuilder;
import net.semanticmetadata.lire.ImageSearchHits;

/**
 * 
 * @author Monumentzo
 *
 */

public class Main {

	/**
	 * <p>
	 * Can be used to either index or query. 
	 * </p><p>
	 * The following arguments will start the indexing process <br/>
	 * 	--images "images/directory" --index "index/directory"
	 * </p><p>
	 * The following arguments will start the query process <br/>
	 * 	--query "query/image/path" --index "index/directory"
	 * </p>
	 * @param args
	 */
	public static void main(String[] args) {

		String queryImagePath = null;
		String imageDirectory = "/home/mick/uni/ti2800/git/offline/LIRe Indexer/monuments";
		String indexDirectory = "/home/mick/uni/ti2800/git/offline/LIRe Indexer/monuments_index";
		
		final int QUERY = 0;
		final int CREATE_INDEX = 1;
		final int UPDATE_SIMILAR = 2;
		
		int action = CREATE_INDEX;
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length; i++) {
			switch(args[i]) {
			case "-q":
			case "--query":
				action = QUERY;
				queryImagePath = args[i + 1];
				break;
				
			case "-s":
			case "--source":
			case "--images":
				imageDirectory = args[i + 1];
				break;
			
			case "-i":
			case "--index":
				indexDirectory = args[i + 1];
				break;
			
			case "-u":
			case "--update":
				action = UPDATE_SIMILAR;
				break;
				
			}
				
		}
		
		// query has precedence over indexing
		switch(action) {
		case QUERY:
			doQuery(queryImagePath, indexDirectory);
			break;
		
		case CREATE_INDEX:
			doCreateIndex(imageDirectory, indexDirectory);
			break;
		
		case UPDATE_SIMILAR:
			doUpdateSimilar(imageDirectory, indexDirectory);
			break;
		}

	}
	
	@SuppressWarnings("deprecation")
	public static void doQuery(String queryImagePath, String indexDirectory) {
		LireImageMatcher lim;
		
		try {
			lim = new LireImageMatcher(indexDirectory);
			int limit = 10;
			ImageSearchHits hits = lim.match(queryImagePath, limit);
			
			for (int i = 0; i < limit; i++) {
			      System.out.println(i + "\t" + hits.score(i) + ": " 
			    		 + hits.doc(i).getField(DocumentBuilder.FIELD_NAME_IDENTIFIER).stringValue());
			}
			
		} catch (Exception e) {
			System.out.println(e.getMessage());
			e.printStackTrace();
		}
	}
	
	public static void doCreateIndex(String imageDirectory, String indexDirectory) {
		try {
			LireIndexer li = new LireIndexer(imageDirectory, indexDirectory);
			
			li.index();
			
		} catch (Exception e) {
			System.out.println(e.getMessage());
			e.printStackTrace();
		}
	}
	
	public static void doUpdateSimilar(String imageDirectory, String indexDirectory) {
	try {
		String databaseURL = "jdbc:mysql://localhost/";
		String schema = "monumentzo";
		String user = "";
		String password = "";
		DatabaseWriter w = new DatabaseWriter(databaseURL, schema, user, password);
		DatabaseSimilarImageUpdater up = new DatabaseSimilarImageUpdater(w);
		
		up.performUpdate(imageDirectory, indexDirectory);
		
	} catch (Exception e) {
		System.out.println(e.getMessage());
		e.printStackTrace();
	}
}

}
