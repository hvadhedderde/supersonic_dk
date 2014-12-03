<?php
/**
* @package duckling.items
* This file contains item frontpage text maintenance functionality
*/

/**
* TypeText, extends views
*/
class TypeText extends Itemtype {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		parent::__construct(get_class());


		// itemtype database
		$this->db = SITE_DB.".item_text";

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Internal text reference name", 
			"error_message" => "Text reference name must be unique"
		));

		// text
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "HTML content",
			"allowed_tags" => "p,h1,h2,h3,h4,ul,ol,downlod",
			"hint_message" => "Write your text in the editor"
		));
	}
}

?>