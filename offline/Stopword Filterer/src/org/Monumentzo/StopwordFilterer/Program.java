package org.Monumentzo.StopwordFilterer;

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
			
			String word;
			
			DatabaseUpdater updater = new DatabaseUpdater(host, database, user, password);
			
			//Read File Line By Line
			while ((word = br.readLine()) != null)   {
				updater.UpdateDatabase(word);
			}
			
			// Close the input stream
			in.close();
		
		} catch (Exception e) {
			System.err.println("Error: " + e.getMessage());
		}
	}
}