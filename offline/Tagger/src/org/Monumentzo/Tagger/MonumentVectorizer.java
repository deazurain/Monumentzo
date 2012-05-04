package org.Monumentzo.Tagger;

import java.util.HashMap;
import java.util.Set;
import java.util.StringTokenizer;

public class MonumentVectorizer {

	public static String Vectorize(Monument monument) {
		
		StringTokenizer tokenizer =
				new StringTokenizer(monument.getName() + " " + monument.getDescription() + " " + monument.getCity());
		HashMap<String, Integer> wordCounts = new HashMap<String, Integer>();		
		
		// Count the words in the current monument
		while(tokenizer.hasMoreTokens()) {
			String word = tokenizer.nextToken();
			
			if(wordCounts.containsKey(word))
				wordCounts.put(word, wordCounts.get(word) + 1);
			else
				wordCounts.put(word, 1);
		}
		
		String vector = "{";
		Set<String> words = wordCounts.keySet();
		
		// Build a json representation of the vector of the monument
		for(String word : words) {
			vector += "\"" + word + "\": " + wordCounts.get(word) + ", ";
		}
		
		// Remove the trailing comma
		int index = vector.lastIndexOf(",");
		if(index > -1)
			vector = vector.substring(0, index);
		
		return vector + "}";
	}
}
