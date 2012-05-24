<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Monumentzo auth user
 */

class Model_User extends Model_Monumentzo_User {
	
	public function getFavoritesList(){
		$result = DB::query(Database::SELECT, 'SELECT MonumentID FROM FavoriteList WHERE UserID = :id')->param(':id', $this->UserID)->execute();
		$result = $result->as_array();
		
		return $result;
	}
	
	public function getVisitedList(){
		$result = DB::query(Database::SELECT, 'SELECT MonumentID FROM VisitedList WHERE UserID = :id')->param(':id', $this->UserID)->execute();
		$result = $result->as_array();
		
		return $result;
	}
	
	public function getWishList(){
		$result = DB::query(Database::SELECT, 'SELECT MonumentID FROM WishList WHERE UserID = :id')->param(':id', $this->UserID)->execute();
		$result = $result->as_array();
		
		return $result;
	}
}
