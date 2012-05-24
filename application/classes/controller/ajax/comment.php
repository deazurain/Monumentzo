<?php

defined('SYSPATH') OR die('No Direct Script Access');

/**
* Javascript called Comment Controller
* 
* The Comment Controller class allows a user to place a comment through an ajax request.
* 
* @author Monumentzo Team
*/

Class Controller_Ajax_Comment extends Controller_Template_Ajax {

    public function action_place() {

        $errors = array();

        $user = Auth::instance()->get_user();

        if(!user) {
            $errors[] = 'You need to be logged in to place a comment';

            $this->json_fail($errors);
        }


    }
}

?>
