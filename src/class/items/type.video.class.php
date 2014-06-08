<?php
/**
* @package duckling.items
* This file contains item video model
*/

/**
* TypeVideo, extends views
*/
class TypeVideo extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_video";

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
			"label" => "Video name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Name of film, documentary or tv-production", 
			"error_message" => "Name must be unique"
		));

		// Description
		$this->addToModel("description", array(
			"id" => "short_description",
			"type" => "text",
			"label" => "Video description",
			"hint_message" => "Write a description of the video"
		));

		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Drag media files here",
			"max" => 4,
			"allowed_formats" => "png,jpg,mp4",
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


	// update item type - based on posted values
	function update($item_id) {

		$query = new Query();
		$IC = new Item();

		$query->checkDbExistance($this->db);


		$entities = $this->data_entities;
		$names = array();
		$values = array();


		$uploads = $IC->upload($item_id, array("proportion" => 88/40, "variant" => "thumbnail", "filegroup" => "image"));
		if($uploads) {
			$values[] = "thumbnail='".$uploads[0]["format"]."'";
		}

		$uploads = $IC->upload($item_id, array("proportion" => 512/288, "variant" => "screendump", "filegroup" => "image"));
		if($uploads) {
			$values[] = "screendump='".$uploads[0]["format"]."'";
		}

		$uploads = $IC->upload($item_id, array("proportion" => 240/320, "variant" => "poster", "filegroup" => "image"));
		if($uploads) {
			$values[] = "poster='".$uploads[0]["format"]."'";
		}

		$uploads = $IC->upload($item_id, array("proportion" => 512/288, "variant" => "video", "filegroup" => "video"));
		if($uploads) {
			$values[] = "video='mov'";
		}


		foreach($entities as $name => $entity) {
			if($entity["value"] != false && $name != "published_at" && $name != "status" && $name != "tags" && $name != "prices") {
				$names[] = $name;
				$values[] = $name."='".$entity["value"]."'";
			}
		}

		if($this->validateList($names, $item_id)) {
			if($values) {
				$sql = "UPDATE ".$this->db." SET ".implode(",", $values)." WHERE item_id = ".$item_id;
//					print $sql;
			}

			if(!$values || $query->sql($sql)) {
				return true;
			}
		}

		return false;
	}

}

?>