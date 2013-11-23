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
			"error_message" => "Headline must be unique"
		));

		// text
		$this->addToModel("text", array(
			"type" => "text",
			"label" => "News post",
			"hint_message" => "Write content of news post"
		));

		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg,mp4",
			"allowed_proportions" => "200/90",
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
}

?>