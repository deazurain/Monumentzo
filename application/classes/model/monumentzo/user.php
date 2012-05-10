<?php defined('SYSPATH') or die('No direct script access');

/**
 * User Model
 * 
 * The User class allows to log a user in or out and register them, next to modifying and getting information about the user. 
 * 
 * @author Monumentzo Team
 */

class Model_Monumentzo_User extends Model_Database {

    private $userID;
    private $username;
    private $password;
    private $emailaddress;
    private $visitedList = null;
    private $favoriteList = null;
    private $wishList = null;

    /*
     * Registers a new user
     * 
     * @param string    The username
     * @param string    The password
     * @param string    The email address
     * @return array    Query result
     */
    public function register($username, $password, $email) {
        $hashed_password = Auth::instance()->hash($password);
        
        $id = DB::insert('user', array('Name', 'HashedPassword', 'EmailAddress'))
                ->bind(':user', $username)
                ->bind(':pass', $hashed_password)
                ->bind(':email', $email)
                ->values(array(':user', ':pass', ':email'))
                ->execute();
        
        return $id;
    }
}

?>
