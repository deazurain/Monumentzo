<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template_Website {

	public function action_index()
	{
		echo '<pre>' . Debug::dump(ORM::factory('Role')->where('Name', '=', 'login')->find()->loaded()) . '</pre>';
		if(! ORM::factory('Role')->where('Name', '=', 'login')->find()->loaded()) {
			echo 'CREATING LOGIN ROLE';

			$role = ORM::factory('Role');
			$role->Name = 'login';
			$role->Description = 'This is required to log the fuck in :D';
			$role->save();
		}


		$user = Auth::instance()->get_user();

		if( $user) {
			echo 'ALREADY LOGGED IN';
		}

		if(! $user) {
			$user = Auth::instance()->login('Mick', 'feestbeest', TRUE);
			echo 'LOGGING IN';
		}


		if(! $user) {
			// test if user has role
			
			$user = ORM::factory('User');
			$user->where($user->unique_key('Mick'), '=', 'Mick')->find();
			
			$login_role = ORM::factory('Role')->where('Name', '=', 'login')->find();

			if(!$login_role->loaded()) {
				echo 'WHY THE FUCK IS THIS NOT LOADED:s';
			}

			if(! $user->has('Role', $login_role)) {
				$user->add('Role', $login_role);
			}

			echo 'CREATING USER';
			// Create the user using form values
			$user = ORM::factory('User');

			$user->Name = 'Mick';
			$user->HashedPassword = Auth::instance()->hash('feestbeest');
			$user->EmailAddress = 'feestbeest@123.nl';

			$user->save();

			try {
			}
			catch (ORM_Validation_Exception $e) {
				echo '<pre>' . $e->errors() . '</pre>';
			}
		}

		$this->template->title = 'Home';
      	$this->template->content = View::factory('home');
	}
}
