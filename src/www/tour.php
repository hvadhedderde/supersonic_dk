<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../config/config.php");

$action = $page->access();


$page->bodyClass("tour");
$page->pageTitle("Supersonic Tour");

// list
if(!$action) {

	$page->header();
	$page->template("tour/list.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
