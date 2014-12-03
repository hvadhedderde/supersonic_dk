<?php
/**
* @package duckling.items
* This file contains item video model
*/

/**
* TypeVideo, extends views
*/
class TypeVideo extends Itemtype {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		parent::__construct(get_class());


		$this->db = SITE_DB.".item_video";

		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"hint_message" => "Date to publish video on site. Until this date video will remain hidden on site. Leave empty for instant publication", 
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
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "Video description",
			"hint_message" => "Write a description of the video"
		));

		// Files
		$this->addToModel("mediae", array(
			"type" => "files",
			"label" => "Drag files here",
			"max" => 4,
			"allowed_formats" => "png,jpg,mp4",
			"hint_message" => "Add images/videos here.<br>Poster: 240x320px<br>Thumbnail: 88x40px<br>Video: 512x288px<br>Screendump: 512x288px<br>Use png or jpg, mp4 or mov.",
		));
	}


	// custom function to add media
	// /janitor/[admin/]#itemtype#/addMedia/#item_id#
	// TODO: implement itemtype checks
	function addMedia($action) {

		// Get posted values to make them available for models
		$this->getPostedEntities();

		if(count($action) == 2) {

			$query = new Query();
			$item_id = $action[1];

			$query->checkDbExistance(UT_ITEMS_MEDIAE);

			$return_values = array();

			$uploads = $this->upload($item_id, array("input_name" => "mediae", "proportion" => 88/40, "variant" => "thumbnail", "formats" => "jpg,png"));
			if($uploads) {
				$query->sql("DELETE FROM ".UT_ITEMS_MEDIAE." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
				$query->sql("INSERT INTO ".UT_ITEMS_MEDIAE." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', '".$uploads[0]["filesize"]."', 0)");

				$return_values[] = array(
					"item_id" => $item_id, 
					"media_id" => $query->lastInsertId(), 
					"name" => $uploads[0]["name"], 
					"variant" => $uploads[0]["variant"], 
					"format" => $uploads[0]["format"], 
					"width" => $uploads[0]["width"], 
					"height" => $uploads[0]["height"],
					"filesize" => $uploads[0]["filesize"]
				);
			}

			$uploads = $this->upload($item_id, array("input_name" => "mediae", "proportion" => 512/288, "variant" => "screendump", "formats" => "jpg,png"));
			if($uploads) {
				$query->sql("DELETE FROM ".UT_ITEMS_MEDIAE." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
				$query->sql("INSERT INTO ".UT_ITEMS_MEDIAE." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', '".$uploads[0]["filesize"]."', 0)");

				$return_values[] = array(
					"item_id" => $item_id, 
					"media_id" => $query->lastInsertId(), 
					"name" => $uploads[0]["name"], 
					"variant" => $uploads[0]["variant"], 
					"format" => $uploads[0]["format"], 
					"width" => $uploads[0]["width"], 
					"height" => $uploads[0]["height"],
					"filesize" => $uploads[0]["filesize"]
				);
			}

			$uploads = $this->upload($item_id, array("input_name" => "mediae", "proportion" => 240/320, "variant" => "poster", "formats" => "jpg,png"));
			if($uploads) {
				$query->sql("DELETE FROM ".UT_ITEMS_MEDIAE." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
				$query->sql("INSERT INTO ".UT_ITEMS_MEDIAE." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', '".$uploads[0]["filesize"]."', 0)");

				$return_values[] = array(
					"item_id" => $item_id, 
					"media_id" => $query->lastInsertId(), 
					"name" => $uploads[0]["name"], 
					"variant" => $uploads[0]["variant"], 
					"format" => $uploads[0]["format"], 
					"width" => $uploads[0]["width"], 
					"height" => $uploads[0]["height"],
					"filesize" => $uploads[0]["filesize"]
				);
			}

			$uploads = $this->upload($item_id, array("input_name" => "mediae", "proportion" => 512/288, "variant" => "video", "formats" => "mov,mp4"));
			if($uploads) {
				$query->sql("DELETE FROM ".UT_ITEMS_MEDIAE." WHERE item_id = $item_id AND variant = '".$uploads[0]["variant"]."'");
				$query->sql("INSERT INTO ".UT_ITEMS_MEDIAE." VALUES(DEFAULT, $item_id, '".$uploads[0]["name"]."', '".$uploads[0]["format"]."', '".$uploads[0]["variant"]."', '".$uploads[0]["width"]."', '".$uploads[0]["height"]."', '".$uploads[0]["filesize"]."', 0)");

				$return_values[] = array(
					"item_id" => $item_id, 
					"media_id" => $query->lastInsertId(), 
					"name" => $uploads[0]["name"], 
					"variant" => $uploads[0]["variant"], 
					"format" => $uploads[0]["format"], 
					"width" => $uploads[0]["width"], 
					"height" => $uploads[0]["height"],
					"filesize" => $uploads[0]["filesize"]
				);
			}

			return $return_values;
		}

		return false;
	}

// 	// update item type - based on posted values
// 	function update($item_id) {
//
// 		$query = new Query();
// 		$IC = new Items();
//
// 		$query->checkDbExistance($this->db);
//
//
// 		$entities = $this->data_entities;
// 		$names = array();
// 		$values = array();
//
//
// 		$uploads = $IC->upload($item_id, array("proportion" => 88/40, "variant" => "thumbnail", "filegroup" => "image"));
// 		if($uploads) {
// 			$values[] = "thumbnail='".$uploads[0]["format"]."'";
// 		}
//
// 		$uploads = $IC->upload($item_id, array("proportion" => 512/288, "variant" => "screendump", "filegroup" => "image"));
// 		if($uploads) {
// 			$values[] = "screendump='".$uploads[0]["format"]."'";
// 		}
//
// 		$uploads = $IC->upload($item_id, array("proportion" => 240/320, "variant" => "poster", "filegroup" => "image"));
// 		if($uploads) {
// 			$values[] = "poster='".$uploads[0]["format"]."'";
// 		}
//
// 		$uploads = $IC->upload($item_id, array("proportion" => 512/288, "variant" => "video", "filegroup" => "video"));
// 		if($uploads) {
// 			$values[] = "video='mov'";
// 		}
//
//
// 		foreach($entities as $name => $entity) {
// 			if($entity["value"] != false && $name != "published_at" && $name != "status" && $name != "tags" && $name != "prices") {
// 				$names[] = $name;
// 				$values[] = $name."='".$entity["value"]."'";
// 			}
// 		}
//
// 		if($this->validateList($names, $item_id)) {
// 			if($values) {
// 				$sql = "UPDATE ".$this->db." SET ".implode(",", $values)." WHERE item_id = ".$item_id;
// //					print $sql;
// 			}
//
// 			if(!$values || $query->sql($sql)) {
// 				return true;
// 			}
// 		}
//
// 		return false;
// 	}

}

?>