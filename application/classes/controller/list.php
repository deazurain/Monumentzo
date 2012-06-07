<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Template_Website {

	public function action_add();
	
	public function action_remove();
	
	public function action_view() {
		
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();

		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$favorites = $user->getFavoritesList();
		$wishList = $user->getWishList();
		$visitedList = $user->getVisitedList();
		
		$this->template->title = 'Favoriete monumenten';
		$this->template->content = View::factory('lists/favorites', array('favorites' => $favorites, 'visited' => $visitedList, 'wish' => $wishList));
	}

}