<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_View extends Controller_Template_Website {
	
	public function action_index() {
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();

		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$favorites = $user->getFavoritesList();
		$wishList = $user->getWishList();
		$visitedList = $user->getVisitedList();
		
		$this->template->title = 'Favoriete monumenten';
		$this->template->content = View::factory('lists/view', array('favorites' => $favorites, 'visited' => $visitedList, 'wish' => $wishList));
	}
	
	public function action_markers() {
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();

		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$favorites = $user->getFavoritesList();
		$visited = $user->getVisitedList();
		$wish = $user->getWishList();
		$markers = array('favorites' => array(), 'visited' => array(), 'wish' => array());
		
		// Store all the favorite markers
		foreach($favorites as $favorite) {
			$monument = new Model_Monument($favorite['MonumentID']);
			array_push($markers['favorites'], array('ID' => $favorite['MonumentID']) + $monument->getLatLong());
		}

		// Store all the visited markers
		foreach($visited as $visted_monument) {
			$monument = new Model_Monument($visted_monument['MonumentID']);
			array_push($markers['visited'], array('ID' => $visted_monument['MonumentID']) + $monument->getLatLong());
		}

		// Store all the wish markers
		foreach($wish as $wish_monument) {
			$monument = new Model_Monument($wish_monument['MonumentID']);
			array_push($markers['wish'], array('ID' => $wish_monument['MonumentID']) + $monument->getLatLong());
		}
		
		if($this->request->is_ajax()) {
			$this->response->headers(array('Content-Type' => 'application/json'))
						  	->body(json_encode($markers));
		}
	}
}