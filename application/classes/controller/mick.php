<?php

class Controller_Mick extends Controller {

	public function action_test() {
		$this->response->body(View::factory('mick/test'));
	}

}

?>

