<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Visited extends Controller_List {
	
	public function action_add(){
		$id = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListVisited = new Model_List_Visited();
		$modelListVisited->add($id, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_remove(){
		$id = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListVisited = new Model_List_Visited();
		$modelListVisited->remove($id, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_view() {
		
		// Get the user that is currently logged in
		$user = Auth::instance()->get_user();
		
		// If there is no user logged in display error page
		if($user === NULL)
			echo 'ERROR';
			
		$visited = $user->getVisitedList();
		$this->template->title = 'Bezochte monumenten';
		$this->template->content = View::factory('lists/visited', array('visited' => $visited));
	}
}
