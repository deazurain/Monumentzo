<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_List_Read implements Model_List {
	
	public static function add($book, $userID) {
		DB::query(Database::INSERT, 
					'INSERT INTO monumentzo.ReadList VALUES (:userID, :book)')
					->bind(':userID', $userID)
					->bind(':book', $book)
					->execute();
	}
	
	public static function remove($book, $userID) {
		DB::query(Database::DELETE, 
					'DELETE FROM monumentzo.FavoriteList WHERE Book = :book AND UserID = :userID')
					->bind(':userID', $userID)
					->bind(':book', $book)
					->execute();
	}
}