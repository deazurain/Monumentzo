<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Wish extends Controller_List {
	
	public function action_add(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListWish = new Model_List_Wish();
		$modelListWish->add($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_remove(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListWish = new Model_List_Wish();
		$modelListWish->remove($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
}