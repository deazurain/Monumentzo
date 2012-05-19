<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template_Website {

	public function action_index() {

		$home = View::factory('home');

		$user = Auth::instance()->get_user();


		if($user) {
			// logged in
			$home->bind('user', $user);

		}
		else {
			// not logged in

		}

		$this->template->title = 'Home';
   	$this->template->content = $home;

	}
}
