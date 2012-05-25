<?php defined('SYSPATH') or die('No direct access allowed!'); 
 
class Test_User extends Kohana_UnitTest_TestCase
{
    
    const TESTER1 = 'tester1';
    const TESTER2 = 'tester2';
    
    //Test if the login function wont login a user that is not in the database.
	public function test_login1() {
		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER1, 'password' => self::TESTER1))
		    ->execute();
		    
		$this->assertTrue( ! Auth::instance()->logged_in());
    }

    //Test if a user is registered (correctly) when given correct information to the register function.
	public function test_register1() {

		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => self::TESTER2, 'email' => self::TESTER2.'@mail.com', 'password' => self::TESTER2, 'password2' => self::TESTER2))
		    ->execute();

		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER2, 'password' => self::TESTER2))
		    ->execute();
		
		$this->assertTrue( Auth::instance()->logged_in());
		
		$user = Auth::instance()->get_user();
		
		$this->assertEquals( self::TESTER2, $user->Name );
		
		$this->assertEquals( self::TESTER2.'@mail.com', $user->EmailAddress);
		
		Auth::instance()->logout();
		
    }

    //Test if password 1 and 2 are different the user is not registered.
    public function test_register2() {
        
        $this->assertTrue( self::TESTER1 != self::TESTER2);
        
		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => self::TESTER1, 'email' => self::TESTER1.'@mail.com', 'password' => self::TESTER1, 'password2' => self::TESTER2,))
		    ->execute();

		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER1, 'password' => self::TESTER1))
		    ->execute();
		
		$this->assertTrue( ! Auth::instance()->logged_in());
		
		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER1, 'password' => self::TESTER2))
		    ->execute();
		
		$this->assertTrue( ! Auth::instance()->logged_in());
	}

    //Test if the same user cant be registered twice.
	public function test_register3() {
		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => self::TESTER2, 'email' => self::TESTER2.'@mail.com', 'password' => self::TESTER2, 'password2' => self::TESTER2,))
		    ->execute();

		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER2, 'password' => self::TESTER2))
		    ->execute();

		$this->assertTrue( ! Auth::instance()->logged_in());
	}
	
    //remove test users from database
	public function test_clear() {
	    
	    Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => self::TESTER2, 'password' => self::TESTER2))
		    ->execute();
	    
	    $user = Auth::instance()->get_user();
	    	    
	    DB::query(Database::DELETE, 
					'DELETE FROM monumentzo.User_Role WHERE UserID = :userID')
					->param(':userID', $user->UserID)
					->execute();
		
	    DB::query(Database::DELETE, 
					'DELETE FROM monumentzo.User WHERE UserID = :userID')
					->param(':userID', $user->UserID)
					->execute();
	}
}

?>