<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Page Controller
 * 
 * Controller that changes the contents of the web page.
 * 
 * @author Monumentzo Team
 */
class Controller_Page extends Controller_Template_Website {

    public function action_home() {
        $this->template->title = 'Monumentzo';
        $this->template->content = View::factory('page/home');
    }

    public function action_login() {
        $this->response->body(View::factory('page/login'));
    }

    public function action_register() {
        
    }

}

?>
