<?php

/**
 * The Monument Model.
 */
class Model_Monument extends Model_Database {

	$monumentID;
	$name;
	$discription;
	$latitude;
	$longitude;
	$city;
	$province;
	$street;
	$streetNumberText;
	$foundationDateText;
	$attributes;
	$categories;

	public function __construct($id){
		parent::__construct()
		$result = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')->bind(':id', $id)->execute();

		$monument = $result[0];
		
		$monumentID			= $id;
		$name 				= $monument->Name;
		$discription 		= $monument->Discription;
		$latitude 			= $monument->Latitude;
		$longitude			= $monument->Latitude;
		$city 				= $monument->City;
		$province 			= $monument->Province;
		$street				= $monument->Street;
		$streetNumberText 	= $monument->StreetNumberText;
		$foundationDateText = $monument->FoundationDateText;
		$attributes 		= $monument->Attributes;
		$categories 		= $monument->Categories;
	}
	
	public function viewMonument(){}
	
	public function getInfo(){}
	
	public function getBaseImage(){}
	
	public function getAllImages(){}
}

?>
