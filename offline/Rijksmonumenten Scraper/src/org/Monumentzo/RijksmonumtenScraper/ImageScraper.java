package org.Monumentzo.RijksmonumtenScraper;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.URL;

public class ImageScraper {

	public static void downloadImage(File output, URL source) {
		
		try {
			/*
			
			System.out.println("path: " + output);
			System.out.println("parent canWrite: " + output.getParentFile().canWrite());
			System.out.println("isFile: " + output.isFile());
			System.out.println("create new file: " + output.createNewFile());
			*/
			if(output.isFile()) return;
			
			// Get a stream to the image
			InputStream in = source.openStream();
			OutputStream out = new BufferedOutputStream(new FileOutputStream(output));
	        
			// Download the image
	        for (int b; (b = in.read()) != -1; ) {
	            out.write(b);
	        }
	        
	        // Close the streams
	        out.close();
	        in.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
}
