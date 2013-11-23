<?php
/**
* @package duckling.items
* This file contains item people departments maintenance functionality
*/

/**
* TypePerson, extends views
*/
class TypePerson extends Model {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		$this->db = SITE_DB.".item_person";


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
			"label" => "Full name",
			"required" => true,
			"hint_message" => "Full name of person", 
			"error_message" => "Full name is required"
		));

		// Nickname
		$this->addToModel("nickname", array(
			"type" => "string",
			"label" => "Nickname",
			"required" => true,
			"hint_message" => "Write persons nickname (short name)", 
			"error_message" => "Nickname is required"
		));

		// email
		$this->addToModel("email", array(
			"type" => "email",
			"label" => "Email",
			"hint_message" => "Write persons contact email",
			"error_message" => "Email is invalid"
		));

		// email
		$this->addToModel("title", array(
			"type" => "string",
			"label" => "Title",
			"hint_message" => "Write persons title",
			"error_message" => "Title is invalid"
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
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg",
			"allowed_proportions" => "232/270",
			"hint_message" => "Add profile image. Use png or jpg.",
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