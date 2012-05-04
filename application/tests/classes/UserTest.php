<?php defined('SYSPATH') or die('No direct access allowed!'); 
 
class Test_User extends Kohana_UnitTest_TestCase
{
	public function test_login()
    {
		$request = Request::factory('user/login')
			->method('POST')
			->post(array('username' => 'bar', 'password' => 'foo'));
		$response = $request->execute();
		$this->assertTrue(!isset($response->content->errors));
    }

    public function test_register()
    {
		$request = Request::factory('user/register')
			->method('POST')
			->post(array('username' => 'bar', 'email' => 'bar@asdf.com', 'password' => 'foo', 'password2' => 'asdf',));
		$response = $request->execute();
		$this->assertTrue(isset($response->content->errors));
    }
}

?>