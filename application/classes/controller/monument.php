<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The User Controller class allows a user to log in and out.
 * Also a new user can register.
 */
Class Controller_Monument extends Controller_Template_Website
{
	public function action_view($id){
		$monument = new monument($id);
		
		$this->template->title = 'Log in';
      $this->template->content = View::factory('monument');
		$this->template->content->monument = $monument;
	}
}

?>