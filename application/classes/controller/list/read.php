<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List_Read extends Controller_List {
	
	public function action_view() {
		$readList = Auth::instance()->get_user()->getReadList();
		
		$this->template->title = 'Leeslijst';
		$this->template->content = View::factory('lists/read', array('readList' => $readList));
	}
	
	public function action_add(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListRead = new Model_List_Read();
		$modelListRead->add($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
	
	public function action_remove(){
		$monumentId = $this->request->param('id');
		$user = Auth::instance()->get_user();
		
		$modelListRead = new Model_List_Read();
		$modelListRead->remove($monumentId, $user->UserID);
		
		// Redirect the user back to the monument page
		$this->request->redirect('monument/view/' . $monumentId);
	}
}