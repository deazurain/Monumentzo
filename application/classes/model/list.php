<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Model_List extends Model_Database {
	
	public abstract function add($monumentID, $userID);
	
	public abstract function remove($monumentID, $userID);
}