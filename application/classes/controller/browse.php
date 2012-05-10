<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Browse extends Controller_Template_Website {

	public function action_index()
	{
		$this->template->title = 'Browse';
      	$this->template->content = View::factory('browse/browse');
	}
}
