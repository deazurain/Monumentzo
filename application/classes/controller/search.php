<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Template_Website {

	private static final $idfThreshold = 1.50;

	public function action_search()
	{
		// Get the query parameters
		$query = $this->request->param('q');
		$resultSize = $this->request->param('rsz', 10);
		
		// Build a vector from the query and get the monuments that contain the query words
		$queryVector = array();
		$monuments = array();
		foreach(explode(' ', $query) as $word) {
			$result = DB::query(Database::SELECT, 'SELECT TextTagID, InverseDocumentFrequency
													FROM monumentzo.TextTag 
													WHERE TextTag = ' . $word);
			
			// Only use words that have a relatively high inverse document frequency
			if($result[0]['InverseDocumentFrequency'] > $idfThreshold) {			
				$queryVector[$word] = ($queryVector[$word])
										? $queryVector[$word]['frequency'] + 1
										: array('frequency' => 1);
				
				// Get the monuments associated with the current word
				$monumentResult = DB::query(Database::SELECT, 'SELECT MonumentID
														FROM monumentzo.Monument_TextTag
														WHERE TextTagID = ' . $result[0]['TextTagID']);
				
				// Store each MonumentID associated to this word														
				for($i = 0; $i < count($result); $i++) {
					array_push($monuments, $monumentResult[i]['MonumentID']);
				}
			}
		}
		
		// Make sure to only select unique monuments
		array_unique($monuments);
		
		// Get the vectors for the monuments
		$monumentVectors = array();
		foreach($monuments as $monument) {
			$result = DB::query(Database::SELECT, 'SELECT MonumentID, Vector 
													FROM monumentzo.Monument 
													WHERE MonumentID = ' . $monument);
			
			// Store each vector of the currently retrieved monument
			$monumentVectors[$result[0]['MonumentID']] = json_decode($result[0]['Vector'], true);			
		}
		
		// Calculate the angles between the $queryVector and each monument vector
		$relevance = array();
		foreach($monumentVectors as $key => $vector) {
			$relevance[$key] = calculate_angle($queryVector, $vector);
		}
		
		// Sort the $relevance of each monument based on its angle
		// between the $queryVector and the vector of the monument
		asort($relevance);
		
		// Get the correct number of search results
		$relevance = array_slice($relevance, 0, $resultSize);
		
		// Get the information from the database
		$results = array();
		foreach($relevance as $monumentID => $angle) {
			$monument = new Model_Monument($monumentID);
			
			$results[$monumentID] = array('name' => $monument->name,
										  'place' => $monument->city,
										  'image' => $monument->getBaseImage());
		}
		
		$this->template->title = 'Search results';
        $this->template->content = View::factory('search/results')->set('results', results);
	}
	
	private function calculate_angle($vector1, $vector2) {
		
		$dot = 0;
		
		// Calculate the angle between the vectors (dot product)
		foreach($vector1 as $key => $value1) {
			$value2 = $vector2[$key] ? $vector2[$key] : 0;
			$dot += $value1 * $value2;
		}
		
		return $dot;
	}
}
