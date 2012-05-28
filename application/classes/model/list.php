<?php defined('SYSPATH') or die('No direct access allowed.');

interface Model_List extends Model_Database {
	
	public static function add($monumentID, $userID);
	
	public static function remove($monumentID, $userID);
}