<?php
/**
* @package duckling.items
* This file contains item people departments maintenance functionality
*/

/**
* TypePerson, extends views
*/
class TypePerson extends Itemtype {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		parent::__construct(get_class());


		$this->db = SITE_DB.".item_person";


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
		$this->addToModel("html", array(
			"type" => "text",
			"label" => "Additional info",
			"hint_message" => "Add descriptional info."
		));

		// Files
		$this->addToModel("main", array(
			"type" => "files",
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg",
			"allowed_proportions" => 232/270,
			"hint_message" => "Add profile image. Use png or jpg.",
			"error_message" => "Image does not fit requirements."
		));

	}
}

?>