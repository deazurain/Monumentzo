<?php

/**
 * The User class allows to log a user in or out
 * and register them, next to modifying and getting
 * information of the user. 
 */
class Model_User extends Model_Database {

	private $userID;
	private $username;
	private $password;
	private $emailaddress;
	private $visitedList = null;
	private $favoriteList = null;
	private $wishList = null;

	/**
	 * Returns a new user object from the database or null
	 * if the credentials are wrong/the user doesn't exist
	 */
	public static function login($username, $password) {
		return null;
	}

}

?>
