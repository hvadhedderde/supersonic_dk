<?php
/**
* @package duckling.items
* This file contains item news maintenance functionality
*/

/**
* TypeNews, extends views
*/
class TypeNews extends Model {

	function __construct() {

		$this->db = SITE_DB.".item_news";

		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"label" => "Publish date (yyyy-mm-dd hh:mm:ss)",
			"pattern" => "^[\d]{4}-[\d]{2}-[\d]{2}[0-9\-\/ \:]*$",
			"hint_message" => "Date to publish news post on site. Until this date news post will remain hidden on site. Leave empty for instant publication", 
			"error_message" => "Date must be of format (yyyy-mm-dd hh:mm:ss)"
		));

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Headline",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "News headline", 
			"error_message" => "Headline must be filled out"
		));

		// text
		$this->addToModel("text", array(
			"type" => "text",
			"label" => "News post description",
			"hint_message" => "Write a short description of the news post"
		));

		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Add images here",
			"max" => 6,
			"allowed_formats" => "png,jpg,mp4",
			"allowed_proportions" => "1/1,",
			"hint_message" => "Add news images/videos here. Use png or jpg, mp4 or mov.",
			"error_message" => "Image does not fit requirements."
		));

		// Tags
		$this->addToModel("tags", array(
			"type" => "tags",
			"label" => "Add tag",
			"hint_message" => "Start typing to get suggestions"
		));

		parent::__construct();
	}


	/**
	* Get item 
	*/
	// function get($id) {
	// 	$query = new Query();
	// 	if($query->sql("SELECT * FROM ".$this->db." WHERE item_id = $id")) {
	// 		$item = array();
	// 		$item["name"] = $query->result(0, "name");
	// 		$item["text"] = $query->result(0, "text");
	// 
	// 		return $item;
	// 	}
	// 	else {
	// 		return false;
	// 	}
	// }

// 
// 
// 	// CMS SECTION
// 
// 
// 	// save item type - based on posted values
// 	function save($item_id) {
// 		$this->vars = getVars($this->varnames);
// 
// 		// does values validate
// 		if($this->validator->validateAll()) {
// 
// 			$IC = new Item();
// 			$IC->upload($item_id, "image");
// 
// 
// 			$query = new Query();
// 
// 			$name = $this->vars["name"];
// 			$text = $this->vars["text"];
// 
// //			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
// 			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')")) {
// 				return true;
// 			}
// 		}
// 
// 		return false;
// 	}
// 
// 	// update item type - based on posted values
// 	function update($item_id) {
// 		$this->vars = getVars($this->varnames);
// 
// 		// does values validate
// //		if($this->validator->validateAll()) {
// 			$IC = new Item();
// 			$IC->upload($item_id, "image");
// 
// 
// 			$query = new Query();
// 
// 			$name = $this->vars["name"];
// 			$text = $this->vars["text"];
// 
// //			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$text')<br>";
// 			if($query->sql("UPDATE ".$this->db." SET name='$name', text='$text' WHERE item_id = $item_id")) {
// 				return true;
// 			}
// //		}
// 
// 		return false;
// 	}
// 
// 
// 
// 
// 
// 	/**
// 	* Get selected item name
// 	*
// 	* @param int $id Item id
// 	* @return string|false Item name or false on error
// 	* @uses Generic::getItemName()
// 	*/
// 	function getItemName($id) {
// 		return Generic::getItemName($id, $this->db);
// 	}
// 
// 	/**
// 	* Get selected item value
// 	*
// 	* @param int $id Item id
// 	* @param String $ Item value
// 	* @return string|false Item value or false on error
// 	* @uses Generic::getItemValue()
// 	*/
// 	function getItemValue($id, $value) {
// 		return Generic::getItemValue($id, $this->db, $value);
// 	}
// 
// 	/**
// 	* Get all items
// 	*
// 	* @param string $which Optional limitation of returned result. ("id", "values", "iso")
// 	* @return array|false Item array or false on error
// 	* @uses Generic::getItems()
// 	*/
// 	function getItems($which=false, $order="date") {
// 		return Generic::getItems($this->db, $which, $order);
// 	}
// 
// 	/**
// 	* Save new item, based on submitted values
// 	*
// 	* @return bool
// 	* @uses Message
// 	*/
// 	function saveItem() {
// 		$item = new Item();
// 
// 		if($this->validator->validateAll()) {
// 			$item_id = $item->saveItem("news");
// 
// 			$date = explode('-', ereg_replace('[/.-]', '-', $this->vars['date']));
// 			$day = isset($date[0]) ? $date[0] : date("d", time());
// 			$month = isset($date[1]) ? $date[1] : date("m", time());
// 			$year = isset($date[2]) ? $date[2] : date("y", time());
// 			$timestamp = $year.$month.$day;
// 
// 			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
// 			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
// 			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
// 			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
// 			$release_timestamp = $release_year.$release_month.$release_day;
// 
// 			if($item_id) {
// 				$vars = "''";
// 				$vars .= ",".$item_id;
// 				$vars .= ",'".$this->vars['name']."'";
// 				$vars .= ",'".$this->vars['text']."'";
// 				$vars .= ",".$timestamp;
// 				$vars .= ",".$release_timestamp;
// 				$vars .= ", 0";
// 				$vars .= ",NULL";
// 
// 				if($this->sql("INSERT INTO ".$this->db." VALUES($vars)")) {
// 					messageHandler()->addStatusMessage($this->translate("Item saved"));
// 					return $this->getLastInsertId();
// 				}
// 				else {
// 					messageHandler()->addErrorMessage($this->dbError());
// 					$item->deleteItem($item_id);
// 					return false;
// 				}
// 			}
// 			else {
// 				messageHandler()->addErrorMessage($this->translate("Unknown error occurred!"));
// 			}
// 		}
// 		else {
// 			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
// 			return false;
// 		}
// 	}
// 
// 	/**
// 	* Update edited item
// 	*
// 	* @param int $id Item id
// 	* @return bool
// 	* @uses Message
// 	*/
// 	function updateItem($id) {
// 		if($this->validator->validateAll()) {
// 
// 			$date = explode('-', ereg_replace('[/.-]', '-', $this->vars['date']));
// 			$day = isset($date[0]) ? $date[0] : date("d", time());
// 			$month = isset($date[1]) ? $date[1] : date("m", time());
// 			$year = isset($date[2]) ? $date[2] : date("y", time());
// 			$timestamp = $year.$month.$day;
// 
// 			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
// 			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
// 			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
// 			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
// 			$release_timestamp = $release_year.$release_month.$release_day;
// 
// 			$vars = "name = '".$this->vars['name']."'";
// 			$vars .= ",text = '".$this->vars['text']."'";
// 			$vars .= ",date='".$timestamp."'";
// 			$vars .= ",release_date='".$release_timestamp."'";
// 			$vars .= ",type = ".$this->vars['type'];
// 
// 			if($this->sql("UPDATE ".$this->db." SET $vars WHERE id = $id")) {
// 				$item = new Item();
// 				$item->setStatus($this->getItemValue($id, "item_id"), $this->vars['status']);
// 				messageHandler()->addStatusMessage($this->translate("Item updated"));
// 				return true;
// 			}
// 			else {
// 				messageHandler()->addStatusMessage($this->dbError());
// 				return false;
// 			}
// 		}
// 		else {
// 			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
// 			return false;
// 		}
// 	}
// 
// 	/**
// 	* Delete selected item
// 	*
// 	* @param int $id Item id
// 	* @return bool
// 	* @uses Message
// 	*/
// 	function deleteItem($id) {
// 		$item = new Item();
// 		$item_id = $this->getItemValue($id, "item_id");
// 
// 		if($this->sql("DELETE FROM ".$this->db." WHERE id = $id")) {
// 			$item->deleteItem($item_id);
// 			FileSystem::removeDirRecursively($this->image_path.$id);
// 
// 			messageHandler()->addStatusMessage($this->translate("Item deleted"));
// 			return true;
// 		}
// 		else {
// 			messageHandler()->addErrorMessage($this->dbError());
// 			return false;
// 		}
// 	}
// 
// 	/**
// 	* Update edited item image
// 	*
// 	* @param int $id Item id
// 	* @return bool
// 	* @uses Message
// 	*/
// 	function updateItemFile($id){
// 
// 		$file_tmp = $_FILES["image"]['tmp_name'];
// 		$file = $_FILES["image"]['name'];
// 		$file_error = $_FILES["image"]['error'];
// 
// 		if($file_tmp && $file && !$file_error){
// 
// 			$image_info = getimagesize($file_tmp);
// 			$image_mime = image_type_to_mime_type($image_info[2]);
// 			if($image_info[0] != $this->image_w || $image_info[1] != $this->image_h || !$image_mime){
// 				messageHandler()->addErrorMessage($this->translate("Image does not fit specifications!")." (".$this->image_w."x".$this->image_h.")");
// 				return false;
// 			}
// 			else {
// 				if(!file_exists($this->image_path)){
// 					mkdir($this->image_path);
// 				}
// 				if(!file_exists($this->image_path."$id")){
// 					mkdir($this->image_path."$id");
// 				}
// 
// 				$this->delfile($this->image_path."$id/*");
// 				copy($file_tmp, $this->image_path."$id/$file");
// 
// 				if($this->sql("UPDATE ".$this->db." SET image='$file' WHERE id = $id")){
// 					messageHandler()->addErrorMessage($this->translate("Image updated"));
// 					return true;
// 				}else{
// 					messageHandler()->addErrorMessage($this->dbError());
// 					return false;
// 				}
// 			}
// 		}
// 		else {
// 			messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
// 			return false;
// 		}
// 	}
// 
// 	function delfile($str) { 
// 		foreach(glob($str) as $fn) { 
// 			//print $fn;
// 			unlink($fn); 
// 		} 
// 	}
}

?>