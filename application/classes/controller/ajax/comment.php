<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
* Javascript called Comment Controller
* 
* The Comment Controller class allows a user to place a comment through an ajax request.
* 
* @author Monumentzo Team
*/

Class Controller_Ajax_Comment extends Controller_Template_Ajax {

    public function action_create() {

        $errors = array();

        $user = Auth::instance()->get_user();

        if(!$user) {
            $errors[] = 'You need to be logged in to place a comment';

            $this->json_fail($errors);
        }

        $data = $_POST;
        $data['UserID'] = $user->UserID;
        $data['PlaceDate'] = date( 'Y-m-d H:i:s', time());

        $c = Model::factory('comment');
        $c->set($data);

        $v = $c->validator();

        if(!$v->check()) {

            $errors = array_merge($errors, array_keys($v->errors()));

            $this->json_fail($errors);

        }
        else {

            $c->save();

            // return place date, comment and username
            $result= $c->get(array('PlaceDate', 'Comment'));
            $result['User'] = $user->Name;

            $this->json_success($result);

        }
    }

}

?>
