<?php
/**
* @package duckling.items
* This file contains item radio maintenance functionality
*/

/**
* TypeAudio, extends views
*/
class TypeAudio {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {


		$this->db = SITE_DB.".item_audio";
//		$this->db = UT_ITE_AUD;

//		$this->file_path = LOCAL_PATH."/library/radio/";

//		$this->validator = new Validator($this);
		$this->varnames["name"] = "Name";
//		$this->validator->rule("name", "unik", "Name exists!", $this->db);

		$this->varnames["description"] = "Additional info";

		// $this->varnames["release_date"] = "Release date";
		// 
		// $this->varnames["status"] = "Status";

		$this->varnames["files"] = "Sound file:";

//		$this->vars = getVars($this->varnames);
	}



	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();
			$item["name"] = $query->result(0, "name");
			$item["description"] = $query->result(0, "description");

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

			$IC = new Item($this->vars);
			$IC->upload($item_id, "audio");

			$query = new Query();
			$name = $this->vars["name"];
			$description = $this->vars["description"];

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$description')")) {
				return true;
			}
		}

		return false;
	}


	// update item type - based on posted values
	function update($item_id) {
		$this->vars = getVars($this->varnames);

		// does values validate
//		if($this->validator->validateAll()) {
			// upload if available in $_FILES
			$IC = new Item();
			$IC->upload($item_id, "audio");


			$query = new Query();

			$name = $this->vars["name"];
			$description = $this->vars["description"];

//			print "UPDATE ".$this->db." SET name='$name', nickname='$nickname', email='$email', title='$title', description='$description' WHERE item_id = $item_id<br>";
			if($query->sql("UPDATE ".$this->db." SET name='$name', description='$description' WHERE item_id = $item_id")) {
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
			$item_id = $item->saveItem("radio");

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			if($item_id) {
				$vars = "''";
				$vars .= ",".$item_id;
				$vars .= ",'".$this->vars['name']."'";
				$vars .= ",'".$this->vars['text']."'";
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
			$vars .= ",text = '".$this->vars['text']."'";
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
		$item_id = $this->getItemValue($id, "item_id");

		if($this->sql("DELETE FROM ".$this->db." WHERE id = $id")) {
			$item->deleteItem($item_id);
			FileSystem::removeDirRecursively($this->file_path.$id);

/*
						// do a little extra cleaning up
						$handle = opendir($this->file_path);
						while($file = readdir($handle)){
							if((substr($file, 0, 1) != ".")){
			//					print $file;
								if($this->getItem($file)) {
			//						print "ok<br>";
								}
								else {
									FileSystem::removeDirRecursively($this->file_path.$file);
									print "delete<br>";
								}
			//					$fileArray[$i++] =  $file;
							}
						}
						closedir($handle);
*/
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
		if(substr($file, -4) != ".mp3") {
			messageHandler()->addErrorMessage($this->translate("File does not meet requirements! (Must be MP3)"));
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