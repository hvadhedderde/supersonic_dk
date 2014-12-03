<?php
/**
* @package duckling.items
* This file contains item audio model
*/

/**
* TypeAudio, extends views
*/
class TypeAudio extends Itemtype {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		parent::__construct(get_class());


		$this->db = SITE_DB.".item_audio";

		// Published
		$this->addToModel("published_at", array(
			"type" => "datetime",
			"hint_message" => "Date to publish audiofile on site. Until this date audiofile will remain hidden on site. Leave empty for instant publication", 
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
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "Additional info",
			"hint_message" => "Add addditional info."
		));

		// Files
		$this->addToModel("main", array(
			"type" => "files",
			"label" => "Drag audiofile here",
			"max" => 6,
			"allowed_formats" => "mp3",
			"hint_message" => "Add audio file here. Use mp3.",
			"error_message" => "Unrecognized format."
		));
	}
}

?>