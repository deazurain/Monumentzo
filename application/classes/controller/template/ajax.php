<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template_Ajax extends Controller {

    protected $content_type = 'application/json';
    protected $cache_control = 'no-cache';

	/**
	* The before() method is called before your controller action.
	* In our template controller we override this method so that we can
	* set up default values. These variables are then available to our
	* controllers if they need to be modified.
	*/
	public  function before() {

        parent::before();

        if(!$this->request->is_ajax()) {
            die('Ajax requests only.');
        }

        $this->response->headers(array(
            'Content-Type' => $this->content_type,
            'Cache-Control' => $this->cache_control,
        ));

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

    protected function json_fail($data) {
        $this->response->body(json_encode(array(
            'status' => 'fail',
            'result' => $data,
        )));
    }

    protected function json_success($data) {
        $this->response->body(json_encode(array(
            'status' => 'success',
            'result' => $data,
        )));
    }

}
