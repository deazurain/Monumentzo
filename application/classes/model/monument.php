<?php

/**
 * The User class allows to log a user in or out
 * and register them, next to modifying and getting
 * information of the user. 
 */
class Model_Monument extends Model_Database {

	private $monumentID;
	private $name;
	private $discription;
	private $latitude;
	private $longitude;
	private $city;
	private $province;
	private $street;
	private $streetNumberText;
	private $foundationDateText;
	private $attributes;
	private $categories;

	public function __construct($id){
		parent::__construct()
		$select = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')
	   	->bind(':id', $id)
		$result = $select->execute();
		$monument = $result[0]
		$name = $monument->Name;
		$discription = $monument->Discription;
		$latitude = $monument->Latitude;
		$longitude = $monument->Latitude;
		$city = $monument->City;
		$province = $monument->Province;
		$street = $monument->Street;
		$streetNumberText = $monument->StreetNumberText;
		$foundationDateText = $monument->FoundationDateText;
		$attributes = $monument->Attributes;
		$categories = $monument->Categories;
		}
	}
	
	public function viewMonument(){}
	
	public function getInfo(){}
	
	public function getBaseImage(){}
	
	public function getAllImages(){}
}

?>
