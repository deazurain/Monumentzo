<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Read extends Controller_List {
	
	public function action_add(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListRead = new Model_List_Read();
		$modelListRead->add($id, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_remove(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListRead = new Model_List_Read();
		$modelListRead->remove($id, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
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