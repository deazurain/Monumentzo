<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Model_List extends Model_Database {
	
	public abstract static function add($monumentID, $userID);
	
	public abstract static function remove($monumentID, $userID);
}