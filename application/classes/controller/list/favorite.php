<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Favorite extends Controller_List {
	
	public function action_add(){

		// Get the needed information
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		// Add the monument to the favorite list of the current user
		$favoriteList = new Model_List_Favorite();		
		$favoriteList->add($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_remove(){
		
		// Get the monument id and the user id to remove the monument from the favorite list of the user
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		// Remove the monument from the user list
		$favoriteList = new Model_List_Favorite();
		$favoriteList->remove($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
}