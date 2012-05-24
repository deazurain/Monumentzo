<?php

defined('SYSPATH') OR die('No Direct Script Access');

/**
* User Controller
* 
* The User Controller class allows a user to log in and out.
* Also a new user can register.
* 
* @author Monumentzo Team
*/

Class Controller_User extends Controller_Template_Plain {

	/**
	* Registers a user. Makes sure the passwords match 
	* and that the username does not already exists.
	*/
	public function action_register() {

		if($this->auto_render) {
			$this->template->title = 'Registreren';
			$this->template->content = View::factory('user/register');
		}
                
		$post = Validation::factory($this->request->post())
			->rule('username', 'not_empty')
			->rule('email', 'not_empty')
			->rule('email', 'email')
			->rule('password', 'not_empty')
			->rule('password', 'matches', array(':validation', 'password', 'password2'));
        
		// Check if the data is valid
		if ($post->check()) {

			// create a new user
			$user = ORM::factory('User');
			$user->Name = $this->request->post('username');
			$user->HashedPassword = Auth::instance()->hash($this->request->post('password'));
			$user->EmailAddress = $this->request->post('email');
			$user->save();

			// add login role to the user
			$login_role = ORM::factory('Role')->where('Name', '=', 'login')->find();
			if (!$login_role) {
				throw new Exception('The login role doesn\'t exist and needs to be created in the database');
			}
			$user->add('Role', $login_role);

			if($this->request->is_ajax()) {
				$this->json_success(array(
					'username' => $user->Name,
				));
			}
			else {
				Request::current()->redirect('');
			}

		}
		else {
			// failed to register, data invalid
			if($this->request->is_ajax()) {
				$this->json_fail(array_keys($post->errors()));
			}
			else {
				// If the validation failed, collect the errors and return them
				$errors = $post->errors('user');
			}
		}
	}

	/**
	* Logs in a user. If the login is successful the user will be
	* redirected. If the login was insuccessful, the previous view
	* will be loaded with an error message.
	*/
	public function action_login() {

		$user = Auth::instance()->get_user();

		if ($user) {
			// already logged in
			Request::current()->redirect('');
		}

		if($this->auto_render) {
			$this->template->title = 'Inloggen';
			$this->template->content = View::factory('user/login');
		}

		$post = Validation::factory($this->request->post())
			->rule('username', 'not_empty')
			->rule('password', 'not_empty');

		if ($post->check()) {
			$success = Auth::instance()->login($this->request->post('username'), $this->request->post('password'));

			if ($success) {
				// Login successful

				if($this->request->is_ajax()) {
					$this->json_success(array(
						'username' => Auth::instance()->get_user()->Name,
					));
				}
				else {
					Request::current()->redirect('');
				}
			}
			else {
				// Login unsuccessful return with error message
				if($this->request->is_ajax()) {
					$this->json_fail(array(
						'Incorrecte gebruikersnaam of wachtwoord.',
					));
				}
				else {
					$this->template->content->errors = 'Incorrecte gebruikersnaam of wachtwoord.';
				}
			}
		}
		else {
			// invalid post input
			if($this->request->is_ajax()) {
				$this->json_fail(array(
						'Voer een gebruikersnaam en wachtwoord in.',
				));
			}
			else {
				$this->template->content->errors = 'Voer een gebruikersnaam en wachtwoord in.';
			}
		}
	}

	/**
	* Logs a user out.
	*/
	public function action_logout() {
		Auth::instance()->logout();
		Request::current()->redirect('');
	}

	private function json_fail($data) {
		$this->response->body(json_encode(array(
			'status' => 'fail',
			'result' => $data,
		)));
	}

	private function json_success($data) {
		$this->response->body(json_encode(array(
			'status' => 'success',
			'result' => $data,
		)));
	}
}

?>
