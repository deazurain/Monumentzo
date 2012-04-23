<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The User Controller class allows a user to log in and out.
 * Also a new user can register.
 */
Class Controller_User extends Controller
{
	/**
	 * Registers a user. Makes sure the passwords match 
	 * and that the username does not already exists.
	 */
    public function action_register()
    {
		$view = View::factory('user/register');
		$post = $this->request->post();
		
		// Validate a form ($_POST)
		if (isset($_POST) && Valid::not_empty($_POST)) {        
			// Validate the login form
			$post = Validation::factory($_POST)
			->rule('username', 'not_empty')
			->rule('password', 'not_empty')
			->rule('password', 'min_length', array(':value', 3));
		}
		
		if( ! empty($post)){
			if ($post['password'] == $post['password2']) {
				Request::current()->redirect('welcome');
			}
			$view->errors = 'Passwords did not match';
		}
		$this->response->body($view);
	}
	
	/**
	 * Logs in a user. If the login is successful the user will be
	 * redirected. If the login was insuccessful, the previous view
	 * will be loaded with an error message.
	 */
	public function action_login()
	{
		$view = View::factory('user/login');
 		$post = $this->request->post();
		$success = Auth::instance()->login($post['username'], $post['password']);
		if ($success)
		{
			// Login successful, redirect
			Request::current()->redirect('welcome');
		}
		
		// Login unsuccessful return with error message
		$view->errors = 'Invalid username or password';

		$this->response->body($view);
	}

	/**
	 * Logs a user out.
	 */
	public function action_logout()
	{
		Auth::instance()->logout();
		Request::current()->redirect('welcome');
	}
}

?>