<?php
/**
* @package duckling.items
* This file contains item clip maintenance functionality
*/

/**
* TypeVideo, extends views
*/
class TypeVideo {

	public $varnames;
	public $vars;
	private $validator;

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = UT_ITE_VID;

//		$this->default_thumb_width = 88;
//		$this->default_thumb_height = 40;
		
//		$this->default_clip_width = 500;
//		$this->default_clip_height = 280;

		$this->validator = new Validator($this);

		$this->varnames["name"] = "Name";
		$this->validator->rule("name", "unik", "Name exists!", $this->db);

		$this->varnames["description"] = "Description";

//		$this->varnames["status"] = "Status";
//		$this->varnames["tags"] = "Tags";

		$this->varnames["files"] = "Files";

//		$this->varnames["release_date"] = "Release date";

//		$this->varnames["screendump"] = "Screendump";
//		$this->validator->rule("screendump", "file");

//		$this->varnames["movie"] = "Movie";
		// $this->varnames["clip_width"] = "Clip width (Default: ".$this->default_clip_width.")";
		// $this->validator->rule("clip_width", "num");
		// $this->varnames["clip_height"] = "Clip height (Default: ".$this->default_clip_height.")";
		// $this->validator->rule("clip_height", "num");

		$this->vars = getVars($this->varnames);

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

			// upload
			$IC = new Item();
			$IC->upload($item_id, "video", "clip");
			$IC->upload($item_id, "image", "thumbnail");


			$query = new Query();

			$name = $this->vars["name"];
			$description = $this->vars["description"];

//			print "INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$description')<br>";
			if($query->sql("INSERT INTO ".$this->db." VALUES(DEFAULT, $item_id, '$name', '$description')")) {
				message()->addMessage("Video item saved");
				return true;
			}
		}

		message()->addMessage("Video item could not be saved", array("type" => "error"));
		return false;
	}

	// update item type - based on posted values
	function update($item_id) {
		$this->vars = getVars($this->varnames);

		// does values validate
//		if($this->validator->validateAll()) {
			// upload if available in $_FILES
			$IC = new Item();
			$IC->upload($item_id, "video", "clip");
			$IC->upload($item_id, "image", "thumbnail");


			$query = new Query();

			$name = $this->vars["name"];
			$description = $this->vars["description"];

//			print "UPDATE ".$this->db." SET name='$name', description='$description' WHERE item_id = $item_id<br>";
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
	* @param string $which Optional limitation of returned result. ("id", "values")
	* @return array|false Item array or false on error
	* @uses Generic::getItems()
	*/
	function getItems($which=false, $order="name") {
		return Generic::getItems($this->db, $which, $order);
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
		
		if($this->validator->validateAll("screendump", "clip_width", "clip_height", "prepost_screendump", "prepost_width", "prepost_height", "vfxshowcase_screendump", "vfxshowcase_width", "vfxshowcase_height")) {
			$item_id = $item->saveItem("clip");

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
				$vars .= ", NULL";
				$vars .= ",".$release_timestamp;
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
				$vars .= ", NULL";
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
		if($this->validator->validateAll("screendump", "clip_width", "clip_height", "prepost_screendump", "prepost_width", "prepost_height", "vfxshowcase_screendump", "vfxshowcase_width", "vfxshowcase_height")) {

			$release_date = explode('-', ereg_replace('[/.-]', '-', $this->vars['release_date']));
			$release_day = isset($release_date[0]) ? $release_date[0] : date("d", time());
			$release_month = isset($release_date[1]) ? $release_date[1] : date("m", time());
			$release_year = isset($release_date[2]) ? $release_date[2] : date("y", time());
			$release_timestamp = $release_year.$release_month.$release_day;

			$vars = "name = '".$this->vars['name']."'";
			$vars .= ",text = '".$this->vars['text']."'";
			$vars .= ",release_date='".$release_timestamp."'";

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
		$item_id = $this->getItemValue($id, "item_id");

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
		$query = new Query();

		$thumbnail_tmp = $_FILES["thumbnail"]['tmp_name'];
		$thumbnail = $_FILES["thumbnail"]['name'];
		$thumbnail_error = $_FILES["thumbnail"]['error'];

		$screendump_tmp = $_FILES["screendump"]['tmp_name'];
		$screendump = $_FILES["screendump"]['name'];
		$screendump_error = $_FILES["screendump"]['error'];

		$clip_tmp = $_FILES["clip"]['tmp_name'];
		$clip = $_FILES["clip"]['name'];
		$clip_error = $_FILES["clip"]['error'];

		$prepost_screendump_tmp = $_FILES["prepost_screendump"]['tmp_name'];
		$prepost_screendump = $_FILES["prepost_screendump"]['name'];
		$prepost_screendump_error = $_FILES["prepost_screendump"]['error'];

		$prepost_tmp = $_FILES["prepost"]['tmp_name'];
		$prepost = $_FILES["prepost"]['name'];
		$prepost_error = $_FILES["prepost"]['error'];

		$vfxshowcase_screendump_tmp = $_FILES["vfxshowcase_screendump"]['tmp_name'];
		$vfxshowcase_screendump = $_FILES["vfxshowcase_screendump"]['name'];
		$vfxshowcase_screendump_error = $_FILES["vfxshowcase_screendump"]['error'];

		$vfxshowcase_tmp = $_FILES["vfxshowcase"]['tmp_name'];
		$vfxshowcase = $_FILES["vfxshowcase"]['name'];
		$vfxshowcase_error = $_FILES["vfxshowcase"]['error'];

//		$thumb_w = 88;
//		$thumb_h = 40;

//		$screendump_w = 500;
//		$screendump_h = 280;

		//$clip_w = 88;
		//$clip_h = 40;

		if(!file_exists($this->file_path)){
			mkdir($this->file_path);
		}
		if(!file_exists($this->file_path."$id")){
			mkdir($this->file_path."$id");
		}

		if($thumbnail_tmp && $thumbnail && !$thumbnail_error) {
			$image_info = getimagesize($thumbnail_tmp);
			$image_mime = image_type_to_mime_type($image_info[2]);
			if($image_info[0] != $this->default_thumb_width || $image_info[1] != $this->default_thumb_height || !$image_mime){
				messageHandler()->addErrorMessage($this->translate("Thumbnail does not fit specifications!")." (".$this->default_thumb_width."x".$this->default_thumb_height.")");
				return false;
			}
			else {
				if(!file_exists($this->file_path."$id/thumbnail")){
					mkdir($this->file_path."$id/thumbnail");
				}

				$this->delfile($this->file_path."$id/thumbnail/*");
				copy($thumbnail_tmp, $this->file_path."$id/thumbnail/$thumbnail");

				if($query->sql("UPDATE ".$this->db." SET thumbnail='$thumbnail' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("Thumbnail updated"));
				}
			}
		}

		// clip and screendump
		if($clip_tmp && $clip && !$clip_error){

			$clip_width = $this->vars['clip_width'] = $this->vars['clip_width'] ? $this->vars['clip_width'] : $this->default_clip_width;
			$clip_height = $this->vars['clip_height'] = $this->vars['clip_height'] ? $this->vars['clip_height'] : $this->default_clip_height;

			// clip requires screendump
			if($screendump_tmp && $screendump && !$screendump_error) {
				$image_info = getimagesize($screendump_tmp);
				$image_mime = image_type_to_mime_type($image_info[2]);
				if($image_info[0] != $clip_width || $image_info[1] != $clip_height || !$image_mime){
					messageHandler()->addErrorMessage($this->translate("Screendump does not fit specifications!")." (".$clip_width."x".$clip_height.")");
					return false;
				}
				else {
					if(!file_exists($this->file_path."$id/screendump")){
						mkdir($this->file_path."$id/screendump");
					}

					$this->delfile($this->file_path."$id/screendump/*");
					copy($screendump_tmp, $this->file_path."$id/screendump/$screendump");

					if($query->sql("UPDATE ".$this->db." SET screendump='$screendump' WHERE id = $id")){
						messageHandler()->addStatusMessage($this->translate("Screendump updated"));
					}
				}
			}

			if($this->validator->validateList("clip_height", "clip_width", "screendump")) {
				if(!file_exists($this->file_path."$id/clip")){
					mkdir($this->file_path."$id/clip");
				}

				$this->delfile($this->file_path."$id/clip/*");
				copy($clip_tmp, $this->file_path."$id/clip/$clip");

				if($query->sql("UPDATE ".$this->db." SET clip='$clip', clip_width='$clip_width', clip_height='$clip_height' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("Clip updated"));
				}
			}
			else {
				messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
				return false;
			}
		}
		// only clip screendump upload
		else if(!$clip && $screendump_tmp && $screendump && !$screendump_error) {

			$clip_width = $this->vars['clip_width'] = $this->vars['clip_width'] ? $this->vars['clip_width'] : $this->default_clip_width;
			$clip_height = $this->vars['clip_height'] = $this->vars['clip_height'] ? $this->vars['clip_height'] : $this->default_clip_height;

			$image_info = getimagesize($screendump_tmp);
			$image_mime = image_type_to_mime_type($image_info[2]);
			if($image_info[0] != $clip_width || $image_info[1] != $clip_height || !$image_mime){
				messageHandler()->addErrorMessage($this->translate("Screendump does not fit specifications!")." (".$clip_width."x".$clip_height.")");
				return false;
			}
			else {
				if(!file_exists($this->file_path."$id/screendump")){
					mkdir($this->file_path."$id/screendump");
				}

				$this->delfile($this->file_path."$id/screendump/*");
				copy($screendump_tmp, $this->file_path."$id/screendump/$screendump");

				if($query->sql("UPDATE ".$this->db." SET screendump='$screendump' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("Screendump updated"));
				}
			}
		}

		// prepost and screendump
		if($prepost_tmp && $prepost && !$prepost_error){

			$prepost_width = $this->vars['prepost_width'] = $this->vars['prepost_width'] ? $this->vars['prepost_width'] : $this->default_prepost_width;
			$prepost_height = $this->vars['prepost_height'] = $this->vars['prepost_height'] ? $this->vars['prepost_height'] : $this->default_prepost_height;

			// clip requires screendump
			if($prepost_screendump_tmp && $prepost_screendump && !$prepost_screendump_error) {
				$image_info = getimagesize($prepost_screendump_tmp);
				$image_mime = image_type_to_mime_type($image_info[2]);
				if($image_info[0] != $prepost_width || $image_info[1] != $prepost_height || !$image_mime){
					messageHandler()->addErrorMessage($this->translate("Pre/Post screendump does not fit specifications!")." (".$prepost_width."x".$prepost_height.")");
					return false;
				}
				else {
					if(!file_exists($this->file_path."$id/prepost_screendump")){
						mkdir($this->file_path."$id/prepost_screendump");
					}

					$this->delfile($this->file_path."$id/prepost_screendump/*");
					copy($prepost_screendump_tmp, $this->file_path."$id/prepost_screendump/$prepost_screendump");

					if($query->sql("UPDATE ".$this->db." SET prepost_screendump='$prepost_screendump' WHERE id = $id")){
						messageHandler()->addStatusMessage($this->translate("Pre/Post screendump updated"));
					}
				}
			}

			if($this->validator->validateList("prepost_height", "prepost_width", "prepost_screendump")) {
				if(!file_exists($this->file_path."$id/prepost")){
					mkdir($this->file_path."$id/prepost");
				}

				$this->delfile($this->file_path."$id/prepost/*");
				copy($prepost_tmp, $this->file_path."$id/prepost/$prepost");

				if($query->sql("UPDATE ".$this->db." SET prepost='$prepost', prepost_width='$prepost_width', prepost_height='$prepost_height' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("Pre/post clip updated"));
				}
			}
			else {
				messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
				return false;
			}
		}
		// only prepost screendump upload
		else if(!$prepost && $prepost_screendump_tmp && $prepost_screendump && !$prepost_screendump_error) {

			$prepost_width = $this->vars['prepost_width'] = $this->vars['prepost_width'] ? $this->vars['prepost_width'] : $this->default_prepost_width;
			$prepost_height = $this->vars['prepost_height'] = $this->vars['prepost_height'] ? $this->vars['prepost_height'] : $this->default_prepost_height;

			$image_info = getimagesize($prepost_screendump_tmp);
			$image_mime = image_type_to_mime_type($image_info[2]);
			if($image_info[0] != $prepost_width || $image_info[1] != $prepost_height || !$image_mime){
				messageHandler()->addErrorMessage($this->translate("Pre/Post screendump does not fit specifications!")." (".$prepost_width."x".$prepost_height.")");
				return false;
			}
			else {
				if(!file_exists($this->file_path."$id/prepost_screendump")){
					mkdir($this->file_path."$id/prepost_screendump");
				}

				$this->delfile($this->file_path."$id/prepost_screendump/*");
				copy($prepost_screendump_tmp, $this->file_path."$id/prepost_screendump/$prepost_screendump");

				if($query->sql("UPDATE ".$this->db." SET prepost_screendump='$prepost_screendump' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("Pre/Post screendump updated"));
				}
			}
		}
		
		if($vfxshowcase_tmp && $vfxshowcase && !$vfxshowcase_error){

			$vfxshowcase_width = $this->vars['vfxshowcase_width'] = $this->vars['vfxshowcase_width'] ? $this->vars['vfxshowcase_width'] : $this->default_vfxshowcase_width;
			$vfxshowcase_height = $this->vars['vfxshowcase_height'] = $this->vars['vfxshowcase_height'] ? $this->vars['vfxshowcase_height'] : $this->default_vfxshowcase_height;

			// clip requires screendump
			if($vfxshowcase_screendump_tmp && $vfxshowcase_screendump && !$vfxshowcase_screendump_error) {
				$image_info = getimagesize($vfxshowcase_screendump_tmp);
				$image_mime = image_type_to_mime_type($image_info[2]);
				if($image_info[0] != $vfxshowcase_width || $image_info[1] != $vfxshowcase_height || !$image_mime){
					messageHandler()->addErrorMessage($this->translate("VFX showcase screendump does not fit specifications!")." (".$vfxshowcase_width."x".$vfxshowcase_height.")");
					return false;
				}
				else {
					if(!file_exists($this->file_path."$id/vfxshowcase_screendump")){
						mkdir($this->file_path."$id/vfxshowcase_screendump");
					}

					$this->delfile($this->file_path."$id/vfxshowcase_screendump/*");
					copy($vfxshowcase_screendump_tmp, $this->file_path."$id/vfxshowcase_screendump/$vfxshowcase_screendump");

					if($query->sql("UPDATE ".$this->db." SET vfxshowcase_screendump='$vfxshowcase_screendump' WHERE id = $id")){
						messageHandler()->addStatusMessage($this->translate("VFX showcase screendump updated"));
					}
				}
			}

			if($this->validator->validateList("vfxshowcase_height", "vfxshowcase_width", "vfxshowcase_screendump")) {
				if(!file_exists($this->file_path."$id/vfxshowcase")){
					mkdir($this->file_path."$id/vfxshowcase");
				}

				$this->delfile($this->file_path."$id/vfxshowcase/*");
				copy($vfxshowcase_tmp, $this->file_path."$id/vfxshowcase/$vfxshowcase");

				if($query->sql("UPDATE ".$this->db." SET vfxshowcase='$vfxshowcase', vfxshowcase_width='$vfxshowcase_width', vfxshowcase_height='$vfxshowcase_height' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("VFX showcase updated"));
				}
			}
			else {
				messageHandler()->addErrorMessage($this->translate("Please complete missing information"));
				return false;
			}
		}
		// only vfx screendump upload
		else if(!$vfxshowcase && $vfxshowcase_screendump_tmp && $vfxshowcase_screendump && !$vfxshowcase_screendump_error) {

			$vfxshowcase_width = $this->vars['vfxshowcase_width'] = $this->vars['vfxshowcase_width'] ? $this->vars['vfxshowcase_width'] : $this->default_vfxshowcase_width;
			$vfxshowcase_height = $this->vars['vfxshowcase_height'] = $this->vars['vfxshowcase_height'] ? $this->vars['vfxshowcase_height'] : $this->default_vfxshowcase_height;

			$image_info = getimagesize($vfxshowcase_screendump_tmp);
			$image_mime = image_type_to_mime_type($image_info[2]);
			if($image_info[0] != $vfxshowcase_width || $image_info[1] != $vfxshowcase_height || !$image_mime){
				messageHandler()->addErrorMessage($this->translate("VFX showcase screendump does not fit specifications!")." (".$vfxshowcase_width."x".$vfxshowcase_height.")");
				return false;
			}
			else {
				if(!file_exists($this->file_path."$id/vfxshowcase_screendump")){
					mkdir($this->file_path."$id/vfxshowcase_screendump");
				}

				$this->delfile($this->file_path."$id/vfxshowcase_screendump/*");
				copy($vfxshowcase_screendump_tmp, $this->file_path."$id/vfxshowcase_screendump/$vfxshowcase_screendump");

				if($query->sql("UPDATE ".$this->db." SET vfxshowcase_screendump='$vfxshowcase_screendump' WHERE id = $id")){
					messageHandler()->addStatusMessage($this->translate("VFX showcase screendump updated"));
				}
			}
		}
		
		return true;
	}

	function delfile($str) { 
		foreach(glob($str) as $fn) { 
			//print $fn;
			unlink($fn); 
		} 
	}
}

?>