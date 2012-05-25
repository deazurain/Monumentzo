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

        $data = $_POST;
        $data['PlaceDate'] = time();

        $c = Model::factory('comment');
        $c->set($_POST);

        $v = $c->validator();

        if(!$v->check()) {

            $errors = array_merge($errors, $v->errors());

            $this->json_fail($errors);

        }
        else {

            $c->save();

            $this->json_success($c->get());

        }
    }

}

?>
