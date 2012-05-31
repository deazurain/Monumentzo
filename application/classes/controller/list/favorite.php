<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Favorite extends Controller_List {
	
	public function action_add(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$favoriteList = new Model_List_Favorite();
		
		echo 'Hello World';
		
		$favoriteList->add($monumentId, $user->UserID);
	}
	
	public function action_remove(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$favoriteList = new Model_List_Favorite();
		$favoriteList->remove($monumentId, $user->UserID);
	}
	
	public function action_markers() {
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();

		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$favorites = $user->getFavoritesList();
		$markers = array();
		
		foreach($favorites as $favorite) {
			$monument = new Model_Monument($favorite['MonumentID']);
			
			// Store all the markers
			array_push($markers, array('ID' => $favorite['MonumentID']) + $monument->getLatLong());
		}
		
		if($this->request->is_ajax()) {
			$this->response->headers(array('Content-Type' => 'application/json'))
						  	->body(json_encode($markers));
		}
	}
	
	public function action_view() {
		
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();

		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$favorites = $user->getFavoritesList();
		$this->template->title = 'Favoriete monumenten';
		$this->template->content = View::factory('lists/favorites', array('favorites' => $favorites));
	}
}