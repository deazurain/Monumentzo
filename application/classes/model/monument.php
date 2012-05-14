<?php

/**
 * The Monument Model.
 */
class Model_Monument extends Model_Database {

	private $monument;

	public function __construct($id){
		parent::__construct();
		$result = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')->bind(':id', $id)->execute();
		
		$result = $result->as_array();
		$this->monument = $result[0];
		$this->monument['Image'] = $this->getBaseImage();
	}
	
	public function viewMonument(){

		return $this->monument;
	}
	
	public function getInfo(){}
	
	public function getBaseImage(){
		$result = DB::query(Database::SELECT, 'SELECT Path FROM Image WHERE ImageID = :id')->bind(':id', $this->monument['ImageID'])->execute();
		$result = $result->as_array();
		
		return $result[0]['Path'];
	}
	
	public function getAllImages(){}
}

?>
