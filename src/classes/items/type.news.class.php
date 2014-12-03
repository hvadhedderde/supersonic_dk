<?php
/**
* @package duckling.items
* This file contains item news maintenance functionality
*/

/**
* TypeNews, extends views
*/
class TypeNews extends Itemtype {

	function __construct() {

		parent::__construct(get_class());


		$this->db = SITE_DB.".item_news";

		// Published
		$this->addToModel("published_at", array(
			"hint_message" => "Date to publish news post on site. Until this date news post will remain hidden on site. Leave empty for instant publication", 
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
		$this->addToModel("html", array(
			"type" => "html",
			"label" => "News post",
			"allowed_tags" => "p,h2,h3,h4,ul",
			"hint_message" => "Write content of news post"
		));

		// Files
		$this->addToModel("main", array(
			"type" => "files",
			"label" => "Drag image here",
			"allowed_formats" => "png,jpg",
			"allowed_proportions" => 200/90,
			"hint_message" => "Add news images here. Use png or jpg",
			"error_message" => "Image does not fit requirements."
		));
	}
}

?>