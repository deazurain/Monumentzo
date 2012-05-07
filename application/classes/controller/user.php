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
Class Controller_User extends Controller_Template_Website {

    /**
     * Registers a user. Makes sure the passwords match 
     * and that the username does not already exists.
     */
    public function action_register() {
        $user = Model::factory('monumentzo_user');

        $this->template->title = 'Registreren';
        $this->template->content = View::factory('user/register');

        $post = Validation::factory($_POST)
                ->rule('username', 'not_empty')
                ->rule('email', 'email')
                ->rule('password', 'matches', array(':validation', 'password', 'password2'));

        // Check if the data is valid
        if ($post->check()) {
            // If the input is correct, register the user
            $user->register($_POST['username'], $_POST['password'], $_POST['email']);
            Request::current()->redirect('home');
        }

        // If the validation failed, collect the errors and return them
        $errors = $post->errors('user');

        $this->response->body->fancybox(View::factory('user/register'))
                ->bind('post', $post)
                ->bind('errors', $errors);
    }

    /**
     * Logs in a user. If the login is successful the user will be
     * redirected. If the login was insuccessful, the previous view
     * will be loaded with an error message.
     */
    public function action_login() {
        $this->template->title = 'Inloggen';
        $this->template->content = View::factory('user/login');

        $post = Validation::factory($_POST)
                ->rule('username', 'not_empty')
                ->rule('password', 'not_empty');

        if ($post->check()) {
            $success = Auth::instance()->login($_POST['username'], $_POST['password']);
            
            if ($success) {
                // Login successful, redirect
                Request::current()->redirect('home');
            } else {
                // Login unsuccessful return with error message
                $this->template->content->errors = 'Incorrecte gebruikersnaam of wachtwoord.';
            }
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
