<?php
/**
* @package duckling.items
* This file contains item people departments maintenance functionality
*/

/**
* TypePerson, extends views
*/
class TypePerson {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_person";
		// itemtype database
//		$this->db = UT_ITE_PER;

		// image size
		$this->image_w = 232;
		$this->image_h = 270;

//		$this->validator = new Validator($this);

		$this->varnames["nickname"] = "Short name";
//		$this->validator->rule("nickname", "txt");

		$this->varnames["name"] = "Name";
//		$this->validator->rule("name", "txt");

		$this->varnames["email"] = "Email";
//		$this->validator->rule("email", "email", "Invalid email");
//		$this->validator->rule("email", "unik", "Email is not unique", $this->db);

		$this->varnames["title"] = "Title";
		// $this->validator->rule("title", "optional");
		// $this->validator->rule("title", "txt");

		$this->varnames["description"] = "Additional info";
//		$this->varnames["release_date"] = "Release date";

		$this->varnames["files"] = "Image (".$this->image_w."x".$this->image_h."):";
//		$this->validator->rule("image", "image");

//		$this->vars = getVars($this->varnames);
	}


	/**
	* Get item
	*/
	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();
			$item["name"] = $query->result(0, "name");
			$item["nickname"] = $query->result(0, "nickname");
			$item["email"] = $query->result(0, "email");
			$item["title"] = $query->result(0, "title");
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

			$IC = new Item();
			$IC->upload($item_id, "image");

			$query = new Query();
			$name = $this->vars["name"];
			$nickname = $this->vars["nickname"];
			$email = $this->vars["email"];
			$title = $this->vars["title"];
			$description = $this->vars["description"];

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$nickname', '$email', '$title', '$description')")) {
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
			$IC->upload($item_id, "image");


			$query = new Query();

			$name = $this->vars["name"];
			$nickname = $this->vars["nickname"];
			$email = $this->vars["email"];
			$title = $this->vars["title"];
			$description = $this->vars["description"];

//			print "UPDATE ".$this->db." SET name='$name', nickname='$nickname', email='$email', title='$title', description='$description' WHERE item_id = $item_id<br>";
			if($query->sql("UPDATE ".$this->db." SET name='$name', nickname='$nickname', email='$email', title='$title', description='$description' WHERE item_id = $item_id")) {
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
	* @param string $which Optional limitation of returned result. ("id", "values")
	* @return array|false Item array or false on error
	* @uses Generic::getItems()
	*/
	function getItems($which=false, $order="name") {
		return Generic::getItems($this->db, $which, $order);
	}


	/**
	*/
	function getItemDepartments($people_id, $which=false) {
		$items["id"] = array();
		$items["values"] = array();
		$itemDepartment = new ItemDepartment();
		$item_id = $this->getItemValue($people_id, "item_id");
		
		$query = new Query();
		$query->sql("SELECT department_id FROM ".$this->db_dep." WHERE item_id = $item_id");

		for($i = 0; $i < $query->getQueryCount(); $i++) {
			$items["id"][] = $query->getQueryResult($i, "department_id");
			$items["values"][] = $itemDepartment->getItemName($query->getQueryResult($i, "department_id"));
		}

		if($which && count($items[$which])) {
			return $items[$which];
		}
		else if(count($items["id"])) {
			return $items;
		}
		else {
			return false;
		}
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
		
		if($this->validator->validateAll("image")) {
			$item_id = $item->saveItem("people");

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			if($item_id) {
				$vars = "''";
				$vars .= ",".$item_id;
				$vars .= ",'".$this->vars['shortname']."'";
				$vars .= ",'".$this->vars['name']."'";
				$vars .= ",'".$this->vars['email']."'";
				$vars .= ",'".$this->vars['title']."'";
				$vars .= ",'".$this->vars['note']."'";
				$vars .= ",".$release_timestamp;
				$vars .= ", NULL";

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
		if($this->validator->validateAll("image")) {

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			$vars = "shortname = '".$this->vars['shortname']."'";
			$vars .= ",name='".$this->vars['name']."'";
			$vars .= ",email='".$this->vars['email']."'";
			$vars .= ",title='".$this->vars['title']."'";
			$vars .= ",note='".$this->vars['note']."'";
			$vars .= ",release_date='".$release_timestamp."'";

			if($this->sql("UPDATE ".$this->db." SET $vars WHERE id = $id")) {
				$this->updateDepartmentInfo($id, $this->vars['departments']);
				$item = new Item();
				if($this->vars['status'] && $this->getItemDepartments($id) || !$this->vars['status']) {
					$item->setStatus($this->getItemValue($id, "item_id"), $this->vars['status']);
				}
				else {
					messageHandler()->addErrorMessage($this->translate("Select department before enabling!"));
				}
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
	* Help function for update item
	*
	* @param Integer $people_id people item id
	* @param Integer $department_id
	* @return bool
	*/
	function updateDepartmentInfo($people_id, $department_ids) {
		$query = new Query();
		$item_id = $this->getItemValue($people_id, "item_id");
		$this->deleteDepartmentInfo($item_id);

		$vars = "''";
		$vars .= ",'".$item_id."'";

		foreach($department_ids as $value) {
			if($value) {
				$vars_end = $vars.",'".$value."'";
				$query->sql("INSERT INTO ".$this->db_dep." VALUES($vars_end)");
			}
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
			$this->deleteDepartmentInfo($id);
			$item->deleteItem($item_id);
			FileSystem::removeDirRecursively($this->image_path.$id);

			messageHandler()->addStatusMessage($this->translate("Item deleted"));
			return true;
		}
		else {
			messageHandler()->addErrorMessage($this->dbError());
			return false;
		}
	}

	/**
	* Delete department info for selected item
	*
	* @param int $id Item id
	* @return bool
	* @uses Message
	*/
	function deleteDepartmentInfo($id) {
		$query = new Query();
		if($query->sql("DELETE FROM ".$this->db_dep." WHERE item_id = $id")) {
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

//		if($this->validator->validateList("image")) {

		$file_tmp = $_FILES["image"]['tmp_name'];
		$file = $_FILES["image"]['name'];
		$file_error = $_FILES["image"]['error'];

		$image_info = getimagesize($file_tmp);
		$image_mime = image_type_to_mime_type($image_info[2]);
		if($image_info[0] != $this->image_w || $image_info[1] != $this->image_h || !$image_mime){
			messageHandler()->addErrorMessage($this->translate("Image does not fit specifications!")." (".$this->image_w."x".$this->image_h.")");
			return false;
		}

		if($file_tmp && $file && !$file_error){

//			$query = new Query();
//			$query->sql("SELECT item_id FROM ".$this->db." WHERE id = $id");
//			$item_id = $query->getQueryResult(0, "item_id");

			if(!file_exists($this->image_path)){
				mkdir($this->image_path);
			}
			if(!file_exists($this->image_path."$id")){
				mkdir($this->image_path."$id");
			}
//			if(!file_exists($this->image_path."$item_id")){
//				mkdir($this->image_path."$item_id");
//			}

			$this->delfile($this->image_path."$id/*");
//			$this->delfile($this->image_path."$item_id/*");
			
			copy($file_tmp, $this->image_path."$id/$file");
//			copy($file_tmp, $this->image_path."$item_id/$file");

			if($this->sql("UPDATE ".$this->db." SET image='$file' WHERE id = $id")){
				messageHandler()->addErrorMessage($this->translate("Image updated"));
				return true;
			}else{
				messageHandler()->addErrorMessage($this->dbError());
				return false;
			}
		}

		else {
			messageHandler()->addErrorMessage($this->translate("Please complete missing information!"));
			return false;
		}
		
//		}
//		else {
//			messageHandler()->addErrorMessage($this->translate("Please complete missing information2"));
//			return false;
//		}
		
	}

	function delfile($str) { 
		foreach(glob($str) as $fn) { 
			unlink($fn); 
		} 
	}
}

?>