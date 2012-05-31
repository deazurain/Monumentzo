<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Model_List extends Model_Database {
	
	public function add($monumentID, $userID);
	
	public function remove($monumentID, $userID);
}