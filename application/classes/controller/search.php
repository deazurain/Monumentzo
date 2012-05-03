<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Template_Website {

	public function action_search()
	{
		$this->template->title = 'Search results';
        $this->template->content = View::factory('search/results');
	}
}