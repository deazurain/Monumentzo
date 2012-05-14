<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Template_Website {

	public function action_favorites() {
		
		// Get the user that is currently logged in
		$userID = // DON'T KNOW HOW TO DO THIS
		
		// If there is no user logged in display error page
		if($user == NULL)
			echo 'ERROR';
			
		$user = new Model_User($userID);
		$favorites = $user->getFavoritesList();
		
		$this->template->title = 'Favoriete monumenten';
		$this->template->content = View::factory('lists/favorites', array('favorites' => $favorites));
	}
	
	public function action_visited() {
		
		// Get the user that is currently logged in
		$userID = // DON'T KNOW HOW TO DO THIS
		
		// If there is no user logged in display error page
		if($user == NULL)
			echo 'ERROR';
			
		$user = new Model_User($userID);
		$visited = $user->getVisitedList();
		
		$this->template->title = 'Bezochte monumenten';
		$this->template->content = View::factory('lists/visited', array('visited' => $visited));
	}
	
	public function action_wanttovisit() {
		
		// Get the user that is currently logged in
		$userID = // DON'T KNOW HOW TO DO THIS
		
		// If there is no user logged in display error page
		if($user == NULL)
			echo 'ERROR';
			
		$user = new Model_User($userID);
		$wishList = $user->getWishList();
		
		$this->template->title = 'Nog te bezoeken monumenten';
		$this->template->content = View::factory('lists/wanttovisit', array('wishList' => $wishList));
	}
}