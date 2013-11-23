<?php
/**
* @package duckling.items
* This file contains item news maintenance functionality
*/

/**
* TypeNews, extends views
*/
class TypeImage extends Model {

	function __construct() {

		$this->db = SITE_DB.".item_image";


		parent::__construct();
	}
}

?>