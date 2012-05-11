<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The Monument Controller class.
 */
Class Controller_Monument extends Controller_Template_Website
{
	public function action_view($id){
		$monument = new monument($id);
		
		$this->template->title = $monument->name;
		$this->template->content = View::factory('monument');
		$this->template->content->monument = $monument;
	}
}

?>