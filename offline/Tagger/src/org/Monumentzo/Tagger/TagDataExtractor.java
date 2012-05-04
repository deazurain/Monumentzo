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
			StringTokenizer tokenizer =
					new StringTokenizer(monument.getName() + " " + monument.getDescription() + " " + monument.getCity());
			
			// Store the word count for each document
			documentTotalCount.put(monument.getMonumentID(), tokenizer.countTokens());
			
			// We also need to keep track of which words has been added
			Set<String> addedWords = new HashSet<String>();
			
			// Count the words in the current document
			while(tokenizer.hasMoreTokens()) {
				String word = tokenizer.nextToken();
				
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
			
			// Increment the correct word document counts
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
				? data.getWordDocumentCount(monument) / documentTotalCount.get(monument)
				: -1.0; 
	}
	
	public double calculateInverseDocumentFrequency(String word) {
		WordData data = wordCounts.get(word);
		return (data != null) ? Math.log10(monumentData.size() / data.getDocumentCount()) : -1.0;
	}
	
	private class WordData {
		
		private int documentCount = 0;
		private HashMap<Integer, Integer> wordDocumentCount = null;
		private Set<Integer> associatedMonuments = new HashSet<Integer>();
		
		public void increaseDocumentCount() {
			documentCount += 1;
		}
		
		public void incrementDocumentWordCount(int documentID) {
			wordDocumentCount.put(documentID, wordDocumentCount.get(documentID) + 1);
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