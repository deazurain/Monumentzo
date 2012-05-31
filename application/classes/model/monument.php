<?php

/**
 * The Monument Model.
 */
class Model_Monument extends Model_Database {

	private $monument;
	
    const idfThreshold = 0.90;
    
	public function __construct($id){
		parent::__construct();
		$result = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')->bind(':id', $id)->execute();
		
		$result = $result->as_array();
		$this->monument = $result[0];
		$this->monument['Image'] = $this->getBaseImage();
		$this->monument['TextTag'] = $this->getTextTags();
	}
	
	public function viewMonument(){

		return $this->monument;
	}
	
	public function getTextTags(){
	    $result = DB::query(Database::SELECT, 
	        'SELECT TextTag 
				FROM TextTag JOIN Monument_TextTag USING (TextTagID) 
				WHERE MonumentID = :id
				 AND InverseDocumentFrequency > :threshold')
	        ->bind(':id', $this->monument['MonumentID'])
	        ->param(':threshold', self::idfThreshold)
	        ->execute();
			
		return $result->as_array();
	}
	
	public function getBaseImage(){
		$result = DB::query(Database::SELECT, 'SELECT Path FROM Image WHERE ImageID = :id')->bind(':id', $this->monument['ImageID'])->execute();
		$result = $result->as_array();
		
		return $result[0]['Path'];
	}
	
	public function getAllImages(){}
	
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
}

?>
