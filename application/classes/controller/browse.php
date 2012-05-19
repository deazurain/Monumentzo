<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Template_Website {
	
	public function action_index()
	{
		$this->template->title = 'Browse';
      	$this->template->content = View::factory('browse/browse');
	}
	
	public function action_info() {
		
		// Get the information of the monuments out of the database
		$result = DB::query(Database::SELECT, 'SELECT monumentzo.monument.MonumentID, monumentzo.image.Path AS Image
												FROM monumentzo.monument, monumentzo.image 
												WHERE monumentzo.monument.MonumentID = monumentzo.image.MonumentID
												LIMIT 20')->execute();
		$result = $result->as_array();
		
		if($this->request->is_ajax()) {
			$this->response->headers(array('Content-Type' => 'application/json'))
						  ->body(json_encode($result));
		}
	}
}
