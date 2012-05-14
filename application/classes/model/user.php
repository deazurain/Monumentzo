<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Monumentzo auth user
 */

class Model_User extends Model_Auth_User { 

	private $user = NULL;

	public function __construct($id) {
		$result = DB::query(Database::SELECT,
							'SELECT * FROM monumentzo.User WHERE UserID = :userID')->bind(':userID', $id)->execute();
		$result = $result->as_array();
		
		$this->user = isset($result[0]) ? $result[0] : NULL;
	}

	public function containsUser() {
		return ($user != NULL);
	}

	public function getWishList() {
		
		// Check if there is a user loaded
		if(!$this->containsUser())
			return NULL;
		
		// Get the wish list of the user
		$result = DB::query(Database::SELECT,
							'SELECT * FROM monumentzo.WishList WHERE UserID = :userID')
							->bind(':userID', $this->user['UserID'])->execute();
		return $result->as_array();
	}
	
	public function getVisitedList() {
		
		// Check if there is a user loaded
		if(!$this->containsUser())
			return NULL;
			
		// Get the visited list of the user
		$result = DB::query(Database::SELECT, 
							'SELECT * FROM monumentzo.VisitedList WHERE UserID = :userID')
							->bind(':userID', $this->user['UserID'])->execute();
		return $result->as_array();
	}
	
	public function getFavoritesList() {
		
		// Check if there is a user loaded
		if(!$this->containsUser())
			return NULL;
			
		// Get the visited list of the user
		$result = DB::query(Database::SELECT, 
							'SELECT * FROM monumentzo.FavoriteList WHERE UserID = :userID')
							->bind(':userID', $this->user['UserID'])->execute();
		return $result->as_array();
	}
}
