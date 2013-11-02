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

		$this->db = SITE_DB.".item_video";
//		$this->db = UT_ITE_VID;

//		$this->default_thumb_width = 88;
//		$this->default_thumb_height = 40;
		
//		$this->default_clip_width = 500;
//		$this->default_clip_height = 280;

//		$this->validator = new Validator($this);

		$this->varnames["name"] = "Name";
//		$this->validator->rule("name", "unik", "Name exists!", $this->db);

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

}

?>