<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Monumentzo auth user
 */

class Model_User extends Model_Monumentzo_User {
	
	public function getFavoritesList(){
		return 'test';
	}
	
	public function getVisitedList(){
		return 'test';
	}
	
	public function getWishList(){
		return 'test';
	}
}
