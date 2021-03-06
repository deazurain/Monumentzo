<?php defined('SYSPATH') OR die('No Direct Script Access');

/**
 * The Monument Controller class.
 */
Class Controller_Monument extends Controller_Template_Website
{
	public function action_view(){
		$id = $this->request->param('id');
		$monument = new Model_Monument($id);
        $user = Auth::instance()->get_user();
        
		$isInFavorite = NULL;
		$isInVisited = NULL;
		$isInWish = NULL;
		$userBooks = array();
	
		if(Auth::instance()->logged_in()) {
			$userID = $user->UserID;
			
			// Check if the monument is in a list of the current user
			$isInFavorite = $monument->isInList($userID, 'Favorite');
			$isInVisited = $monument->isInList($userID, 'Visited');
			$isInWish = $monument->isInList($userID, 'Wish');
			$userBooks = $user->getReadListIDs();
		}
        $this->template->content = View::factory('monument');
		
		$comments = $monument->getPostedComments();
		$this->template->content->similarImages = $monument->getAllImages();
		$this->template->content->events = $monument->getRelatedEvents();
		$this->template->content->persons = $monument->getRelatedPersons();
		$this->template->content->books = $monument->getBooks();
                $this->template->content->videos = $monument->getVideos();
		$this->template->content->userBooks = $userBooks;
		
		$monument = $monument->viewMonument();
		
		$this->template->title = $monument['Name'];
		$this->template->content->monument = $monument;
		$this->template->content->comments = $comments;
		$this->template->content->inList = array('inFavorite' => $isInFavorite, 'inVisited' => $isInVisited, 'inWish' => $isInWish);
		$this->template->content->user = Auth::instance()->get_user();
	}
}

?>