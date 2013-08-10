<?php
/**
* @package duckling.items
* This file contains item frontpage text maintenance functionality
*/

/**
* TypeText, extends views
*/
class TypeText {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// itemtype database
		$this->db = UT_ITE_TEX;


		// initiate helpers before calling View construct
		$this->validator = new Validator($this);

		$this->varnames["name"] = "Name";
		$this->validator->rule("name", "unik", "Name exists!", $this->db);

		$this->varnames["text"] = "Text";

	}



	// get item type details
	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();
			$item["name"] = $query->result(0, "name");
			$item["text"] = $query->result(0, "text");

			return $item;
		}
		else {
			return false;
		}
	}



	// CMS SECTION


	// save item type - based on posted values
	function save($item_id) {
		$this->vars = getVars($this->varnames);

		// does values validate
		if($this->validator->validateAll()) {
			$query = new Query();

			$name = $this->vars["name"];
			$text = $this->vars["text"];

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')")) {
				return true;
			}
		}

		return false;
	}

	// update item type - based on posted values
	function update($item_id) {

		$this->vars = getVars($this->varnames);

		// does values validate
		// change validator to handle individdual validation with message collection

//		if($this->validator->validateAll()) {
			$query = new Query();

			$name = $this->vars["name"];
			$text = $this->vars["text"];

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("UPDATE ".$this->db." SET name='$name', text='$text' WHERE item_id = $item_id")) {
				return true;
			}
//		}

		return false;
	}


}

?>