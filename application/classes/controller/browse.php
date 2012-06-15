<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Template_Website {

	public function action_index() {
		$this->template->scripts[] = 'assets/js/three.js';
		$this->template->scripts[] = 'assets/js/browse.js';

		$this->template->title = 'Browse';
    $this->template->content = View::factory('browse/browse');
	}
	
	public function action_info() {
		
		// Get the information of the monuments out of the database
		$q = DB::query(Database::SELECT, '
			SELECT Monument.MonumentID, Monument.Name, Path AS Image, Monument.FoundationYear AS Year,
				Longitude, Latitude
			FROM Monument, Image
			WHERE Monument.MonumentID = Image.MonumentID
			LIMIT 100');
		$result = $q->execute();

		$result = $result->as_array();
		
		if($this->request->is_ajax()) {
			$this->response->headers(array('Content-Type' => 'application/json'))
						  ->body(json_encode($result));
		}
	}
}
