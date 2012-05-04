package org.monumentzo.lire;
/**
 * 
 * @author mick
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
		
		// Get the settings from the commandline
		for(int i = 0; i < args.length - 1; i++) {
			switch(args[i]) {
			case "-q":
			case "--query":
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
			}
		}
		
		// query has precedence over indexing
		if(queryImagePath != null) {
			doQuery(queryImagePath, indexDirectory);
		}
		else {
			doCreateIndex(imageDirectory, indexDirectory);
		}

	}
	
	public static void doQuery(String queryImagePath, String indexDirectory) {
		LireImageMatcher lim;
		
		try {
			lim = new LireImageMatcher(indexDirectory);

			lim.match(queryImagePath, 10);
			
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

}
