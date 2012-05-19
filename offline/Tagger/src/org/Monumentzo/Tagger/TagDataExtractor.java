package org.Monumentzo.Tagger;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;
import java.util.StringTokenizer;

public class TagDataExtractor {

	ArrayList<Monument> monumentData = null;
	HashMap<Integer, Integer> documentTotalCount = null;
	HashMap<String, WordData> wordCounts = null;
	
	public TagDataExtractor(ArrayList<Monument> monuments) {
		monumentData = monuments;
	}
	
	public void extractWordCounts() {
		documentTotalCount = new HashMap<Integer, Integer>();
		wordCounts = new HashMap<String, WordData>();
		int documentCount = monumentData.size();
		
		// Count the words in all the documents
		for(int i = 0; i < documentCount; i++) {
			Monument monument = monumentData.get(i);
			
			System.out.println("Extracting words from monument: " + monument.getName() + "(" + i + "/" + documentCount + ")");
			
			String text = sanitize(monument.getName() + " " + monument.getDescription() + " " + monument.getCity());
			StringTokenizer tokenizer = new StringTokenizer(text);
			
			// Store the word count for each document
			documentTotalCount.put(monument.getMonumentID(), tokenizer.countTokens());
			
			// We also need to keep track of which words has been added
			Set<String> addedWords = new HashSet<String>();
			
			// Count the words in the current document
			while(tokenizer.hasMoreTokens()) {
				String word = tokenizer.nextToken().toLowerCase();
				
				// Skip certain words like "." or "/"
				if(word.compareTo(".") == 0 || word.compareTo("/") == 0 || 
					word.compareTo("-") == 0 || word.length() <= 1)
					continue;
				
				if(wordCounts.containsKey(word)) {
					WordData data = wordCounts.get(word);
					data.incrementDocumentWordCount(monument.getMonumentID());
					
					addedWords.add(word);
				} else {
					WordData data = new WordData();
					data.incrementDocumentWordCount(monument.getMonumentID());
					
					wordCounts.put(word, data);
					addedWords.add(word);
				}
			}
			
			// Increment the correct word document counts and associate the current document
			Iterator<String> iterator = addedWords.iterator();
		    while (iterator.hasNext()) {
		      WordData data = wordCounts.get(iterator.next());
		      
		      data.increaseDocumentCount();
		      data.associateMonument(monument.getMonumentID());
		    }
		}
	}
	
	public Set<String> getWords() {
		return wordCounts.keySet();
	}
	
	public double calculateTermFrequency(int monument, String word) {
		WordData data = wordCounts.get(word);
		return data.getAssociatedMonuments().contains(monument)
				? (double)data.getWordDocumentCount(monument) / (double)documentTotalCount.get(monument)
				: -1.0; 
	}
	
	public double calculateInverseDocumentFrequency(String word) {
		WordData data = wordCounts.get(word);
		return (data != null) ? Math.log10((double)monumentData.size() / (double)data.getDocumentCount()) : -1.0;
	}
	
	private String sanitize(String text) {
		
		String result = null;
		
		// Remove the following characters: (, ), ",", \, /
		result = text.replaceAll("\\(|\\)|,|\\|/|;", " ");
		
		// Trim left and right spaces
		result = result.trim();
		
		// Remove trailing periods
		result = result.replaceAll("\\.(?=\\s|$)", " ");
		
		// Change multiple spaces to a single space
		result = result.replaceAll("( )\\1+", " ");
		
		return result;
	}
	
	private class WordData {
		
		private int documentCount = 0;
		private HashMap<Integer, Integer> wordDocumentCount = new HashMap<Integer, Integer>();
		private Set<Integer> associatedMonuments = new HashSet<Integer>();
		
		public void increaseDocumentCount() {
			documentCount += 1;
		}
		
		public void incrementDocumentWordCount(int documentID) {
			
			if(wordDocumentCount.containsKey(documentID)) {
				wordDocumentCount.put(documentID, wordDocumentCount.get(documentID) + 1);
			} else {
				wordDocumentCount.put(documentID, 1);
			}
		}
		
		public void associateMonument(int monumentID) {
			associatedMonuments.add(monumentID);
		}
		
		public int getDocumentCount() {
			return documentCount;
		}
		
		public int getWordDocumentCount(int index) {
			return wordDocumentCount.get(index);
		}
		
		public Set<Integer> getAssociatedMonuments() {
			return associatedMonuments;
		}
	}
}