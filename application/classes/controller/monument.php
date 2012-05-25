<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The Monument Controller class.
 */
Class Controller_Monument extends Controller_Template_Website
{
	public function action_view(){
		$id = $this->request->param('id');
		$monument = new Model_Monument($id);

		$comments = $monument->getPostedComments();
		$monument = $monument->viewMonument();
		
		$this->template->title = $monument['Name'];
		$this->template->content = View::factory('monument');
		$this->template->content->monument = $monument;
		$this->template->content->comments = $comments;
		$this->template->content->user = Auth::instance()->get_user();
	}
	
	public function action_test(){
		$this->action_view(437);
	}
}

?>