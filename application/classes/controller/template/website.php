<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template_Website extends Controller_Template
{
    public $template = 'template/website';

    /**
     * The before() method is called before your controller action.
     * In our template controller we override this method so that we can
     * set up default values. These variables are then available to our
     * controllers if they need to be modified.
     */
    public function before() {
        parent::before();
        if ($this->auto_render) {
            // Initialize empty values
            $this->template->title   = '';
            $this->template->content = '';
            $this->template->styles = array();
            $this->template->scripts = array(); 
        }
    }
     
    /**
     * The after() method is called after your controller action.
     * In our template controller we override this method so that we can
     * make any last minute modifications to the template before anything
     * is rendered.
     */
    public function after() {
        if ($this->auto_render) {
            $styles = array(
            'assets/css/main.css' => 'screen, projection',
			'assets/css/bootstrap.css' => 'screen, projection',
			'assets/css/bootstrap-responsive.css' => 'screen, projection',
            );
            $scripts = array(
            'http://code.jquery.com/jquery.min.js',
			'assets/js/bootstrap.js',
			'assets/js/fancybox/jquery.mousewheel-3.0.4.pack.js',
			'assets/js/fancybox/jquery.fancybox-1.3.4.pack.js',
            );
            $this->template->styles = array_merge( $this->template->styles, $styles );
            $this->template->scripts = array_merge( $this->template->scripts, $scripts );
        }
        parent::after();
    }
}
