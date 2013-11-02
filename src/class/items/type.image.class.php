<?php
/**
* @package duckling.items
* This file contains item frontpage image maintenance functionality
*/


/**
* TypeImage, extends views
*/
class TypeImage {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {
//		$this->validator = new Validator($this);
		
//		$this->db = UT_ITE_IMA;
		$this->db = SITE_DB.".item_image";
//		$this->db_tag = UT_ITE_ITE_TAG;

//		$this->file_path = LOCAL_PATH."/library/frontpages/";

		$this->varnames["name"] = "Name";
		$this->varnames["link"] = "Link";

		// $this->varnames["status"] = "Status";
		// 
		// $this->varnames["tags"] = "Tags";
		$this->varnames["files"] = "Image";

//		$this->vars = getVars($this->varnames);
	}



	function get($id) {
		$query = new Query();
		if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
			$item = array();

			$item["name"] = $query->result(0, "name");
			$item["link"] = $query->result(0, "link");
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
		return Generic::getItemValue($id, $this->db, "file");
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
	*/
	function getItems($which=false, $order="file") {
		$items = array();
		$query = new Query();
		$query->sql("SELECT id, link, file FROM ".$this->db.($order ? " ORDER BY $order" : ""));
		
		for($i = 0; $i < $query->getQueryCount(); $i++) {
			$items["id"][$i] = $query->getQueryResult($i, "id");
			$items["values"][$i] = $query->getQueryResult($i, "file") ? basename($query->getQueryResult($i, "file")) : $query->getQueryResult($i, "link");
		}

		if(!count($items)) {
			return false;
		}
		else if($which) {
			return $items[$which];
		}
		else {
			return $items;
		}
	}

	/**
	*/
	function getItemTags($frontpage_id, $which=false) {
		$items["id"] = array();
		$items["values"] = array();
		$itemTag = new ItemTag();
		$item_id = $this->getItemValue($frontpage_id, "item_id");
		
		$query = new Query();
		$query->sql("SELECT tag_id FROM ".$this->db_tag." WHERE item_id = $item_id");

		for($i = 0; $i < $query->getQueryCount(); $i++) {
			$items["id"][] = $query->getQueryResult($i, "tag_id");
			$items["values"][] = $itemTag->getItemName($query->getQueryResult($i, "tag_id"));
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
		
		if($this->validator->validateAll()) {
			$item_id = $item->saveItem("frontpage_image");
			
			if($item_id) {
				$vars = "''";
				$vars .= ",".$item_id;
				$vars .= ",'".$this->vars['link']."'";
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
		if($this->validator->validateAll()) {
			
			$vars = "link = '".$this->vars['link']."'";

			if($this->sql("UPDATE ".$this->db." SET $vars WHERE id = $id")) {
				$this->updateTagInfo($id, $this->vars['tags']);
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
	* Help function for update item
	*
	* @param Integer $people_id people item id
	* @param Integer $department_id
	* @return bool
	*/
	function updateTagInfo($frontpage_id, $tag_ids) {
		$query = new Query();
		$item_id = $this->getItemValue($frontpage_id, "item_id");
		$this->deleteTagInfo($item_id);

		$vars = "''";
		$vars .= ",'".$item_id."'";

		foreach($tag_ids as $value) {
			$vars_end = $vars.",'".$value."'";
			$query->sql("INSERT INTO ".$this->db_tag." VALUES($vars_end)");
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
			$this->deleteTagInfo($id);
			$item->deleteItem($item_id);
			FileSystem::removeDirRecursively($this->file_path."$id");

			messageHandler()->addStatusMessage($this->translate("Item deleted"));
			return true;
		}
		else {
			messageHandler()->addErrorMessage($this->dbError());
			return false;
		}
	}

	/**
	* Delete tag info for selected item
	*
	* @param int $id Item id
	* @return bool
	* @uses Message
	*/
	function deleteTagInfo($id) {
		$query = new Query();
		if($query->sql("DELETE FROM ".$this->db_tag." WHERE item_id = $id")) {
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
		$w = 785;
		$h = 355;

		$image_info = getimagesize($file_tmp);
		$image_mime = image_type_to_mime_type($image_info[2]);
		if($image_info[0] != $w || $image_info[1] != $h || !$image_mime){
			messageHandler()->addErrorMessage($this->translate("Image does not fit specifications!")." (".$w."x".$h.")");
			return false;
		}

		if($file_tmp && $file && !$file_error){

			if(!file_exists($this->file_path)){
				mkdir($this->file_path);
			}

			if(!$id) {
				global $id;
				$id = $this->saveItem();
			}

			if(!file_exists($this->file_path."$id")){
				mkdir($this->file_path."$id");
			}

			$this->delfile($this->file_path."$id/*");
			copy($file_tmp, $this->file_path."$id/$file");

			// make thumbnail
			$imageTool = new ImageTools();
			$imageTool->scaleImage($this->file_path."$id/$file", $this->file_path."$id/", 40, 88, 10, "thumbnail_".$file);

			if($this->sql("UPDATE ".$this->db." SET file='$file' WHERE id = $id")){
				messageHandler()->addStatusMessage($this->translate("Image updated"));
				return true;
			}else{
				messageHandler()->addErrorMessage($this->dbError());
				$this->deleteItem($id);
				return false;
			}
		}else{
			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
			$this->deleteItem($id);
			return false;
		}
	}
	function delfile($str) { 


		foreach(glob($str) as $fn) { 
			unlink($fn); 
		} 
	}
}

?>