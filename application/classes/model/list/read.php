<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_List_Read extends Model_Database {
	
	public function add($book, $userID) {
		DB::query(Database::INSERT, 
					'INSERT INTO monumentzo.ReadList VALUES (:userID, :book)')
					->bind(':userID', $userID)
					->bind(':book', $book)
					->execute();
	}
	
	public function remove($book, $userID) {
		DB::query(Database::DELETE, 
					'DELETE FROM monumentzo.FavoriteList WHERE Book = :book AND UserID = :userID')
					->bind(':userID', $userID)
					->bind(':book', $book)
					->execute();
	}
}