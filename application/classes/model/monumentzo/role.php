<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Default auth role
 *
 * @package    Monumentzo/Auth
 * @author     Monumentzo Team
 * @copyright  (c) 2012 Monumentzo Team
 */
class Model_Monumentzo_Role extends ORM {

	protected $_object_name = 'Role';
	protected $_table_name = 'Role';
	protected $_primary_key = 'RoleID';

	// Relationships
	protected $_has_many = array(
		'User' => array(
			'model' => 'User',
			'through' => 'User_Role', 
			'foreign_key' => 'RoleID', 
			'far_key' => 'UserID',
		),
	);

	public function rules()
	{
		return array(
			'Name' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('max_length', array(':value', 32)),
			),
			'Description' => array(
				array('max_length', array(':value', 255)),
			)
		);
	}

} // End Auth Role Model
