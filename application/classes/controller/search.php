<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Template_Website {

	private static final $idfThreshold = 0.350;

	public function action_search()
	{
		// Get the query string
		$query = $this->request->param('q');
		
		// Build a vector from the query
		$queryVector = array();
		foreach(explode($query) as $word) {
			$idf = DB::query(Database::SELECT, 'SELECT idf FROM Monumentzo.TermIndex');
			
			if($idf > $idfThreshold) {			
				$queryVector[$word] = ($queryVector[$word]) ? $queryVector[$word] += 1 : 1;
			}
		}
		
		
		
		$results = array();
		
		$this->template->title = 'Search results';
        $this->template->content = View::factory('search/results')->set('results', results);
	}
}