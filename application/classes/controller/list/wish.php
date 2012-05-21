<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Wish extends Controller_List {
	
	public function action_add(){
		$id = $this->request->param('id');
		
		Model_List_Favorite::add($id);
	}
	
	public function action_remove(){
		$id = $this->request->param('id');
		
		Model_List_Favorite::remove($id);
	}
	
	public function action_view() {
		
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();
		
		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';
			
		$wishList = $user->getWishList();
		$this->template->title = 'Nog te bezoeken monumenten';
		$this->template->content = View::factory('lists/wanttovisit', array('wishList' => $wishList));
	}
}