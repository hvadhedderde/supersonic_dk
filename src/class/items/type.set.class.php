<?php
/**
* @package duckling.items
* This file contains item frontpage text maintenance functionality
*/

/**
* TypeSet, extends views
*/
class TypeSet {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {
		// initiate helpers before calling View construct
		$this->validator = new Validator($this);

		$this->db = UT_ITE_SET;

		$this->varnames["name"] = "Name";
		$this->validator->rule("name", "unik", "Name exists!", $this->db);

		$this->varnames["text"] = "Frontpage text";

		$this->vars = getVars($this->varnames);
	}




	/**
	* Create a unique sindex (search index for this model)
	*
	* @param int $id Item id
	*/
	// function sindexBase($id) {
	// 	$query = new Query();
	// 	if($query->sql("SELECT name FROM ".$this->db." WHERE id = " . $id)) {
	// 		return $query->result(0, "name");
	// 	}
	// 	return false;
	// }

	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();
			$item["name"] = $query->result(0, "name");
			$item["type"] = $query->result(0, "type");

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


//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', DEFAULT)")) {
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

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("UPDATE ".$this->db." SET name='$name' WHERE item_id = $item_id")) {
				return true;
			}
//		}

		return false;
	}





	/**
	* Get selected item
	* Makes query result available
	*
	* @param int $id Item id
	* @return bool
	* @uses Generic::getItem()
	*/
	function getItem($id) {
		return Generic::getItem($id, $this->db);
	}

	/**
	* Get selected item name
	*
	* @param int $id Item id
	* @return string|false Item name or false on error
	* @uses Generic::getItemName()
	*/
	function getItemName($id) {
		return Generic::getItemName($id, $this->db);
	}

	/**
	* Get selected item value
	*
	* @param int $id Item id
	* @param String $ Item value
	* @return string|false Item value or false on error
	* @uses Generic::getItemValue()
	*/
	function getItemValue($id, $value) {
		return Generic::getItemValue($id, $this->db, $value);
	}

	/**
	* Get all items
	*
	* @param string $which Optional limitation of returned result. ("id", "values", "iso")
	* @return array|false Item array or false on error
	* @uses Generic::getItems()
	*/
	function getItems($which=false, $order="name") {
		return Generic::getItems($this->db, $which, $order);
	}

	/**
	* Get status options for select
	*
	* @return array|false Item array or false on error
	*/
	function getStatusOptions() {
		$options["id"][] = 1;
		$options["values"][] = $this->translate("Enabled");
		$options["id"][] = 0;
		$options["values"][] = $this->translate("Disabled");
		return $options;
	}

	/**
	* Save new item, based on submitted values
	*
	* @return bool
	* @uses Message
	*/
	function saveItem() {
		$item = new Item();
		
		if($this->validator->validateAll()) {
			$item_id = $item->saveItem("frontpage_text");
			
			if($item_id) {
				$vars = "''";
				$vars .= ",".$item_id;
				$vars .= ",'".$this->vars['name']."'";
				$vars .= ",'".$this->vars['text']."'";

				if($this->sql("INSERT INTO ".$this->db." VALUES($vars)")) {
					messageHandler()->addStatusMessage($this->translate("Item saved"));
					return $this->getLastInsertId();
				}
				else {
					messageHandler()->addErrorMessage($this->dbError());
					$item->deleteItem($item_id);
					return false;
				}
			}
			else {
				messageHandler()->addErrorMessage($this->translate("Unknown error occurred!"));
			}
		}
		else {
			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
			return false;
		}
	}

	/**
	* Update edited item
	*
	* @param int $id Item id
	* @return bool
	* @uses Message
	*/
	function updateItem($id) {
		if($this->validator->validateAll("name")) {

			//$vars = "name = '".$this->vars['name']."'";
			//$vars .= ",text = '".$this->vars['text']."'";
			$vars = "text = '".$this->vars['text']."'";

			if($this->sql("UPDATE ".$this->db." SET $vars WHERE id = $id")) {
				$item = new Item();
				$item->setStatus($this->getItemValue($id, "item_id"), $this->vars['status']);
				messageHandler()->addStatusMessage($this->translate("Item updated"));
				return true;
			}
			else {
				messageHandler()->addStatusMessage($this->dbError());
				return false;
			}
		}
		else {
			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
			return false;
		}
	}

	/**
	* Delete selected item
	*
	* @param int $id Item id
	* @return bool
	* @uses Message
	*/
	function deleteItem($id) {
		$item = new Item();
		$item_id = $this->getItemValue("item_id");

		if($this->sql("DELETE FROM ".$this->db." WHERE id = $id")) {
			$item->deleteItem($item_id);
			messageHandler()->addStatusMessage($this->translate("Item deleted"));
			return true;
		}
		else {
			messageHandler()->addErrorMessage($this->dbError());
			return false;
		}
	}

}

?>