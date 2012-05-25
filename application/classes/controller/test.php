<?php

class Controller_Test extends Controller_Template_Plain {

    public $template = 'template/plain';

    /**
     * The before() method is called before your controller action.
     * In our template controller we override this method so that we can
     * set up default values. These variables are then available to our
     * controllers if they need to be modified.
     */
    public function before() {

        parent::before();

    }

    public function action_index() {

        $content = View::factory('comment/create');
        $content->set('user', Auth::instance()->get_user());

        $this->template->set('content', $content);

    }

    /**
     * The after() method is called after your controller action.
     * In our template controller we override this method so that we can
     * make any last minute modifications to the template before anything
     * is rendered.
     */
    public function after() {

        parent::after();

    }
}