<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_List_Wish extends Model_List {
	
	public static function add($monumentID, $userID) {
		DB::query(Database::INSERT, 
					'INSERT INTO monumentzo.WishList VALUES (:userID, :monumentID)')
					->bind(':userID', $userID)
					->bind(':monumentID', $monumentID)
					->execute();
	}
	
	public static function remove($monumentID, $userID) {
		DB::query(Database::DELETE, 
					'DELETE FROM monumentzo.WishList WHERE MonumentID = :monumentID AND UserID = :userID')
					->bind(':userID', $userID)
					->bind(':monumentID', $monumentID)
					->execute();
	}
}