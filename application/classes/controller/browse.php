<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Template_Website {

	 public function before()
	 {
		 $this->auto_render = ! $this->request->is_ajax();
		 if($this->auto_render === TRUE){
			parent::before();
		 }
	 }

	public function action_index()
	{
		$this->template->title = 'Browse';
      	$this->template->content = View::factory('browse/browse');
	}
	
	public function action_info() {
		
		// Get the information of the monuments out of the database
		$result = DB::query(Database::SELECT, 'SELECT MonumentID, ImagePath AS Image
												FROM monumentzo.monument, monumentzo.image 
												WHERE monumentzo.monument.MonumentID = monumentzo.image.MonumentID
												LIMIT 20');
		$result = $result->as_array();
		
		if($this->request->is_ajax()) {
			// Return json to the caller
			$this->request->header['Content-Type'] = 'application/json';
			$this->request->response = json_encode($result);
		}
	}
}
