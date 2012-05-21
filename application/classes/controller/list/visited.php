<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Visited extends Controller_List {
	
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
		$userID = Auth::instance()->get_user();
		
		// If there is no user logged in display error page
		if($userID === NULL)
			echo 'ERROR';
			
		$user = new Model_User($userID);
		$visited = $user->getVisitedList();
		
		$this->template->title = 'Bezochte monumenten';
		$this->template->content = View::factory('lists/visited', array('visited' => $visited));
	}
