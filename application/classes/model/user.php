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
	

	public static function register($username, $password){
		$insert = DB::query(Database::INSERT, 'INSERT INTO User (Name, HashedPassword) VALUES (:user, :pass)')
		    ->bind(':user', $username)
		    ->bind(':pass', $password);
		return $insert->execute();
	}

}

?>
