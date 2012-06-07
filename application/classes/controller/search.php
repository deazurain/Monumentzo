<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Template_Website {

	const idfThreshold = 0.90;

	public function action_query()
	{
		// Get the query parameters
		$query = $this->request->post('q');
		
		if($this->request->param('id') != ""){
		    $query = $this->request->param('id');
	    }
		
		$resultSize = $this->request->post('rsz');
		
		// Build a vector from the query and get the monuments that contain the query words
		$queryVector = array();
		$monuments = array();
		foreach(explode(' ', $query) as $word) {
			$results = DB::query(Database::SELECT, 'SELECT TextTagID, InverseDocumentFrequency
													FROM monumentzo.TextTag 
													WHERE TextTag LIKE :word')->param(':word', '%' . $word . '%')->execute();
			$results = $results->as_array();

			// If the query words of the user can't be found skip
			if(count($results) <= 0) {
				continue;
			}

			// Only use words that have a relatively high inverse document frequency
			foreach($results as $result) {
				if($result['InverseDocumentFrequency'] > self::idfThreshold) {			
					$queryVector[$word] = isset($queryVector[$word])
											? $queryVector[$word]['frequency'] + 1
											: array('frequency' => 1);
					
					// Get the monuments associated with the current word
					$monumentResult = DB::query(Database::SELECT, 'SELECT MonumentID
															FROM monumentzo.Monument_TextTag
															WHERE TextTagID = :tagID')->param(':tagID', $result['TextTagID'])->execute();
					$monumentResult = $monumentResult->as_array();
	
					// Store each MonumentID associated to this word														
					for($i = 0; $i < count($monumentResult); $i++) {
						array_push($monuments, $monumentResult[$i]['MonumentID']);
					}
				}
			}
		}
		
		// Make sure to only select unique monuments
		array_unique($monuments);

		// Get the vectors for the monuments
		$monumentVectors = array();
		foreach($monuments as $monumentID) {
			$result = DB::query(Database::SELECT, 'SELECT MonumentID, Vector 
													FROM monumentzo.Monument 
													WHERE MonumentID = :monumentID')->param(':monumentID', $monumentID)->execute();
			$result = $result->as_array();
			
			// Store each vector of the currently retrieved monument
			$monumentVectors[$result[0]['MonumentID']] = json_decode($result[0]['Vector'], true);			
		}
		
		// Calculate the angles between the $queryVector and each monument vector
		$relevance = array();
		foreach($monumentVectors as $key => $vector) {
			$relevance[$key] = $this->calculate_angle($queryVector, $vector);
		}
		
		// Sort the $relevance of each monument based on its angle
		// between the $queryVector and the vector of the monument
		asort($relevance);

		// Get the correct number of search results
		if(count($relevance) > $resultSize) {
			$relevance = array_slice($relevance, 0, $resultSize, true);
		}
		
		// Get the information from the database
		$results = array();
		foreach($relevance as $monumentID => $angle) {
			$result = DB::query(Database::SELECT, 'SELECT Name, City, Path as Image 
								FROM monumentzo.Monument, monumentzo.Image 
								WHERE monumentzo.Monument.MonumentID = monumentzo.Image.MonumentID 
								AND monumentzo.Monument.MonumentID = :monumentID')->param(':monumentID', $monumentID)->execute();
			$result = $result->as_array();

			if(count($result) < 1)
				continue;

			$results[$monumentID] = array('MonumentID' => $monumentID,
			        		'Name' => $result[0]['Name'],
							'Place' => $result[0]['City'],
							'Image' => $result[0]['Image']);
		}


		$this->template->title = 'Search results';
		$this->template->content = View::factory('search/results')->set('results', $results);
	}
	
	private function calculate_angle($vector1, $vector2) {
		
		$dot = 0;

		// Calculate the angle between the vectors (dot product)
		foreach($vector1 as $word1 => $value1) {
			foreach($vector2 as $word2 => $value2) {
				if(stristr($word2, $word1) !== false)
					$dot += doubleval($value1) * doubleval($value2);
			}
		}
		
		return $dot;
	}
}
