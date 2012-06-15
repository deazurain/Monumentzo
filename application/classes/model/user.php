<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Monumentzo auth user
 */

class Model_User extends Model_Monumentzo_User {
	
	public function getFavoritesList(){
		$result = DB::query(Database::SELECT, 'SELECT Monument.MonumentID, Name 
												FROM FavoriteList, Monument 
												WHERE FavoriteList.MonumentID = Monument.MonumentID 
												AND UserID = :id')->param(':id', $this->UserID)->execute();
		return $result->as_array();
	}
	
	public function getVisitedList(){
		$result = DB::query(Database::SELECT, 'SELECT Monument.MonumentID, Name 
												FROM VisitedList, Monument 
												WHERE VisitedList.MonumentID = Monument.MonumentID 
												AND UserID = :id')->param(':id', $this->UserID)->execute();
		return $result->as_array();
	}
	
	public function getWishList(){
		$result = DB::query(Database::SELECT, 'SELECT Monument.MonumentID, Name 
												FROM WishList, Monument 
												WHERE WishList.MonumentID = Monument.MonumentID 
												AND UserID = :id')->param(':id', $this->UserID)->execute();
		return $result->as_array();
	}
	
	public function getReadList() {
		$result = DB::query(Database::SELECT, 'SELECT * 
												FROM ReadList 
												WHERE UserID = :id')->param(':id', $this->UserID)->execute();
		
		return $result->as_array();
	}
}
