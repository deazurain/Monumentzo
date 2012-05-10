<?php defined('SYSPATH') or die('No direct script access');

/**
 * User Model
 * 
 * The User class allows to log a user in or out and register them, next to modifying and getting information about the user. 
 * 
 * @author Monumentzo Team
 */
class Model_Monumentzo_User extends ORM {

	protected $_table_name = 'User';
	protected $_primary_key = 'UserID';

	/*
	protected $_belongs_to = array(
		'[alias name]' => array(
			'model'       => '[model name]',
			'foreign_key' => '[column]',
		),
	);

	public function rules() {
		return array(
			'Name' => array(
				array('not_empty'),
				array('min_length', array(':value', 2)),
				array('max_length', array(':value', 32)),
      	array('regex', array(':value', '/^[-\pL\pN_.]++$/uD')),
      ),
			'HashedPassword' => array(
				array('not_empty'),
			),
			'EmailAddress' => array(
				array('not_empty'),
				array('min_length', array(':value', 6)),
				array('max_length', array(':value', 255)),
				array('email'),
			),
		);
	} // rules
 
  public function filters() {
		return array(
			'HashedPassword' => array(
					array(array($this, 'filter_hash_password')),
			),
		);
	}

	public function validate_username($username) {
		// make sure user name is available
		return ORM::factory('member', array('username' => $username))->loaded();
	}

	public function filter_password($password) {
		// Do something to hash the password
		
	}

	*/
}

?>
