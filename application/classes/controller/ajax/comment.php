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

		if (!$user) {
			$errors[] = 'You need to be logged in to place a comment';

			$this->json_fail($errors);
		}

		$data = $_POST;
		$data['UserID'] = $user->UserID;
		$data['PlaceDate'] = date('Y-m-d H:i:s', time());

		$c = Model::factory('comment');
		$c->set($data);

		$v = $c->validator();

		if (!$v->check()) {

			$errors = array_merge($errors, array_keys($v->errors()));

			$this->json_fail($errors);

		}
		else {

			$c->save();

			$result = $c->get(); // get comment data as array

			$commentView = View::factory('model/comment');
			$commentView->set('id', $result['CommentID']);
			$commentView->set('name', $user->Name);
			$commentView->set('placeDate', $result['PlaceDate']);
			$commentView->set('comment', $result['Comment']);
			$commentView->set('owner', ($user && ($user->UserID === $result['UserID'])) ? true : false);

			$this->json_success((string)$commentView);

		}
	}

	public function action_remove() {

		$errors = array();

		$user = Auth::instance()->get_user();

		if (!$user) {
			$errors[] = 'You need to be logged in to remove a comment';

			$this->json_fail($errors);
			return;
		}

		$data = $_POST;
		$data['UserID'] = $user->UserID;

		$r = DB::select('*')->from('Comment')
			->where('CommentID', '=', $data['CommentID'])
			->and_where('UserID', '=', $data['UserID'])->execute();

		if ($r->count() === 1) {
			DB::delete('Comment')->where('CommentID', '=', $data['CommentID'])->execute();
			$this->json_success(null);
		}
		else {
			$this->json_fail($errors);
		}

	}
}

?>
