<?php
/**
* @package duckling.items
* This file contains item audio model
*/

/**
* TypeAudio, extends views
*/
class TypeAudio extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_audio";

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
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Audio name", 
			"error_message" => "Audio name must be unique"
		));

		// text
		$this->addToModel("description", array(
			"type" => "text",
			"label" => "Additional info",
			"hint_message" => "?"
		));

		// Files
		$this->addToModel("files", array(
			"type" => "files",
			"label" => "Drag audiofile here",
			"max" => 6,
			"allowed_formats" => "mp3",
			"hint_message" => "Add audio file here. Use mp3.",
			"error_message" => "Unrecognized format."
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