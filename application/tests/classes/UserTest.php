<?php defined('SYSPATH') or die('No direct access allowed!'); 
 
class Test_User extends Kohana_UnitTest_TestCase
{
    //Test if the login function wont login a user that is not in the database.
	public function test_login1()
    {
		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => 'tester1', 'password' => 'test'))
		    ->execute();
		    
		$this->assertTrue( ! Auth::instance()->logged_in());
    }

    //Test if a user is registered when given correct information to the register function.
	public function test_register1()
    {
		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => 'tester2', 'email' => 'tester2@mail.com', 'password' => 'test', 'password2' => 'test'))
		    ->execute();

		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => 'tester2', 'password' => 'test'))
		    ->execute();
		
		$this->assertTrue( Auth::instance()->logged_in());
    }

    //Test if password 1 and 2 are different the user is not registered.
    public function test_register2()
    {
		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => 'tester1', 'email' => 'tester1@mail.com', 'password' => 'test', 'password2' => 'notest',))
		    ->execute();
		    
		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => 'tester1', 'password' => 'test'))
		    ->execute();
		
		$this->assertTrue( ! Auth::instance()->logged_in());
	}

    //Test if the same user cant be registered twice.
	public function test_register3()
    {
		Request::factory('/user/register')
			->method(Request::POST)
			->post(array('username' => 'tester2', 'email' => 'tester2@mail.com', 'password' => 'test2', 'password2' => 'test2',))
		    ->execute();

		Request::factory('/user/login')
			->method(Request::POST)
			->post(array('username' => 'tester2', 'password' => 'test2'))
		    ->execute();

		$this->assertTrue( ! Auth::instance()->logged_in());
	}
}

?>