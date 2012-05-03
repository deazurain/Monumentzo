<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The User Controller class allows a user to log in and out.
 * Also a new user can register.
 */
Class Controller_User extends Controller_Template_Website
{
	/**
	 * Registers a user. Makes sure the passwords match 
	 * and that the username does not already exists.
	 */
	public function action_register() {

		$this->template->title = 'Log in';
		$this->template->content = View::factory('user/register');
		
		if(isset($_POST) && ! empty($_POST)) {
			if ($_POST['password'] == $_POST['password2']) {
				Request::current()->redirect('welcome');
			}
			$this->template->content->errors = 'Passwords did not match';
		}
	}
	
	/**
	 * Logs in a user. If the login is successful the user will be
	 * redirected. If the login was insuccessful, the previous view
	 * will be loaded with an error message.
	 */
	public function action_login() {

		$this->template->title = 'Log in';
    $this->template->content = View::factory('user/login');
		
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$success = Auth::instance()->login($_POST['username'], $_POST['password']);
			if ($success) {
				// Login successful, redirect
				Request::current()->redirect('welcome');
			}
			
			// Login unsuccessful return with error message
			$this->template->content->errors = 'Invalid username or password';
		}

		
	}

	/**
	 * Logs a user out.
	 */
	public function action_logout() {
		Auth::instance()->logout();
		Request::current()->redirect('welcome');
	}
}

?>
