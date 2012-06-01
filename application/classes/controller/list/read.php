<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Read extends Controller_List {
	
	public function action_add(){
		$id = $this->request->param('id');
		
		Model_List_Read::add($id);
	}
	
	public function action_remove(){
		$id = $this->request->param('id');
		
		Model_List_Read::remove($id);
	}
	
	public function action_view() {
		
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();
		
		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';

		$books = $user->getReadList();		
		$this->template->title = 'Boekenlijst';
		$this->template->content = View::factory('lists/favorites', array('books' => $books));
	}
}