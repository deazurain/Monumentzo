<?php

/**
 * The Monument Model.
 */
class Model_Monument extends Model_Database {

    private $monument;

    const idfThreshold = 0.90;

    public function __construct($id) {
        parent::__construct();
        $result = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')->bind(':id', $id)->execute();

        $result = $result->as_array();
        $this->monument = $result[0];
        $this->monument['Image'] = $this->getBaseImage();
        $this->monument['TextTag'] = $this->getTextTags();
        $this->monument['Category'] = $this->getCategory();
    }

    public function viewMonument() {

        return $this->monument;
    }

    public function getTextTags() {
        $result = DB::query(Database::SELECT, 'SELECT TextTag 
				FROM TextTag JOIN Monument_TextTag USING (TextTagID) 
				WHERE MonumentID = :id
				 AND InverseDocumentFrequency > :threshold')
                ->bind(':id', $this->monument['MonumentID'])
                ->param(':threshold', self::idfThreshold)
                ->execute();

        return $result->as_array();
    }

    public function getBaseImage() {
        $result = DB::query(Database::SELECT, 'SELECT Path FROM Image WHERE ImageID = :id')->bind(':id', $this->monument['ImageID'])->execute();
        $result = $result->as_array();

        return $result[0]['Path'];
    }

    public function getAllImages() {
        $result = DB::query(Database::SELECT, 'SELECT Path, MonumentID, Name
												FROM Image NATURAL JOIN Monument
												WHERE ImageID IN (
													SELECT SimilarImageID 
													FROM SimilarImage 
													WHERE SimilarImage.ImageID = :imageID
												)')
                ->bind(':imageID', $this->monument['ImageID'])
                ->execute();

        return $result->as_array();
    }

    public function getPostedComments() {
        $result = DB::query(Database::SELECT, 'SELECT CommentID, Comment.UserID, Name, Comment, PlaceDate
												FROM monumentzo.Comment, monumentzo.User 
												WHERE User.UserID = Comment.UserID 
												 AND MonumentID = :id')
                ->bind(':id', $this->monument['MonumentID'])
                ->execute();

        return $result->as_array();
    }

    public function getLatLong() {
        return array('Lat' => $this->monument['Latitude'], 'Long' => $this->monument['Longitude']);
    }

    public function isInList($userID, $list) {

        $result = DB::query(Database::SELECT, 'SELECT * FROM monumentzo.' . $list . 'List WHERE MonumentID = :monumentID AND UserID = :userID')
                ->bind(':monumentID', $this->monument['MonumentID'])
                ->bind(':userID', $userID)
                ->execute();

        return count($result->as_array()) > 0;
    }

    public function getRelatedPersons() {

        $result = DB::query(Database::SELECT, 'SELECT Name 
												FROM Person, Monument_Person 
												WHERE Person.PersonID = Monument_Person.PersonID 
												AND MonumentID = :monumentID')
                ->bind(':monumentID', $this->monument['MonumentID'])
                ->execute();

        return $result->as_array();
    }

    public function getRelatedEvents() {

        $result = DB::query(Database::SELECT, 'SELECT Name, Year
												FROM Event, Monument_Event 
												WHERE Event.EventID = Monument_Event.EventID 
												AND MonumentID = :monumentID')
                ->bind(':monumentID', $this->monument['MonumentID'])
                ->execute();

        return $result->as_array();
    }

    public function getBooks() {
        $results = DB::query(Database::SELECT, 'SELECT Book.BookID, Title, Author, ImgUrl , Link
												FROM Book, Monument_Book 
												WHERE Book.BookID = Monument_Book.BookID 
												AND MonumentID = :monumentID')
                ->param(':monumentID', $this->monument['MonumentID'])
                ->execute();

        return $results->as_array();
    }
    
    public function getVideos() {
        $results = DB::query(Database::SELECT, 'SELECT Video.YouTubeID
												FROM Video, Monument_Video 
												WHERE Video.VideoID = Monument_Video.VideoID 
												AND MonumentID = :monumentID')
                ->param(':monumentID', $this->monument['MonumentID'])
                ->execute();

        return $results->as_array();
    }
    
    public function getCategory() {
        $results = DB::query(Database::SELECT, 'SELECT Category FROM Category, Monument_Category 
												WHERE Category.CategoryID = Monument_Category.CategoryID 
												AND MonumentID = :monumentID')
                ->param(':monumentID', $this->monument['MonumentID'])
                ->execute();
        
        return $results->as_array();
    }

}

?>
