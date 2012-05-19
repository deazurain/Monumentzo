<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_List extends Controller_Template_Website {

	public abstract function action_add();
	
	public abstract function action_remove();
	
	public abstract function action_view();

}