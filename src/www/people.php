<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../config/config.php");

$action = $page->access();


$page->bodyClass("people");
$page->pageTitle("Supersonic People");

// list
if(!$action) {

	$page->header();
	$page->template("people/list.php");
	$page->footer();

}
// view - check for id
else if(isset($action[0])) {

	$page->header();
	$page->template("people/view.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
