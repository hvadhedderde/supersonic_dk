<?php
/**
* @package duckling.items
* This file contains item about maintenance functionality
*/

/**
* TypeDownload, extends views
*/
class TypeDownload {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_download";
//		$this->db = UT_ITE_DOW;

//		$this->validator = new Validator($this);
		$this->varnames["name"] = "Name";
//		$this->validator->rule("name", "unik", "Name exists!", $this->db);

		// $this->varnames["release_date"] = "Release date";
		// $this->varnames["status"] = "Status";

		$this->varnames["files"] = "File:";

//		$this->vars = getVars($this->varnames);
	}


	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();
			$item["name"] = $query->result(0, "name");
			$item["extension"] = $query->result(0, "extension");
			$item["mimetype"] = $query->result(0, "mimetype");
//
//			$item["release_date"] = $query->result(0, "release_date");
//			$item["file"] = $query->result(0, "file");

			return $item;
		}
		else {
			return false;
		}
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
	function getItems($which=false, $order="sequence") {
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
			$item_id = $item->saveItem("about");

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			if($item_id) {
				$vars = "''";
				$vars .= ",".$item_id;
				$vars .= ",'".$this->vars['name']."'";
				$vars .= ",".$release_timestamp;
				$vars .= ", NULL";
				$vars .= ", 0";

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
		if($this->validator->validateAll()) {

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			$vars = "name = '".$this->vars['name']."'";
			$vars .= ",release_date='".$release_timestamp."'";

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
			FileSystem::removeDirRecursively($this->file_path.$id);

			messageHandler()->addStatusMessage($this->translate("Item deleted"));
			return true;
		}
		else {
			messageHandler()->addErrorMessage($this->dbError());
			return false;
		}
	}

	/**
	* Update edited item image
	*
	* @param int $id Item id
	* @return bool
	* @uses Message
	*/
	function updateItemFile($id){

		$file_tmp = $_FILES["file"]['tmp_name'];
		$file = $_FILES["file"]['name'];
		$file_error = $_FILES["file"]['error'];

		/*
		if(substr($file, -4) != ".mov") {
			messageHandler()->addErrorMessage($this->translate("File does not meet requirements! (Must be MOV)"));
			return false;
		}
		*/

		if($file_tmp && $file && !$file_error){

			if(!file_exists($this->file_path)){
				mkdir($this->file_path);
			}
			if(!file_exists($this->file_path."$id")){
				mkdir($this->file_path."$id");
			}

			$this->delfile($this->file_path."$id/*");
			copy($file_tmp, $this->file_path."$id/$file");

			if($this->sql("UPDATE ".$this->db." SET file='$file' WHERE id = $id")){
				messageHandler()->addErrorMessage($this->translate("File updated"));
				return true;
			}else{
				messageHandler()->addErrorMessage($this->dbError());
				return false;
			}
		}else{
			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
			return false;
		}
	}

	/**
	* Update structure
	*
	* @param int $id Item id
	* @return bool
	* @uses getVar
	* @uses Message
	*/
	function updateStructure($id) {
		print_r($id);
		$sequence = array();
		$updates = 0;

		for($i = 0; $i < count($id); $i++) {
			if($this->sql("UPDATE ".$this->db." SET sequence = ".$i." WHERE id = ".$id[$i])) {
				$updates++;
			}
		}
		if($updates == count($id)) {
			messageHandler()->addStatusMessage($this->translate("Structure updated"));
			return true;
		}
		else {
			messageHandler()->addErrorMessage($this->dbError());
			return false;
		}
	}
	
	function delfile($str) { 
		foreach(glob($str) as $fn) { 
			//print $fn;
			unlink($fn); 
		} 
	}

}

?>