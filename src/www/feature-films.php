<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();
$IC = new Item();


$page->bodyClass("film");
$page->pageTitle("Supersonic Feature Films");

// list
if(!$action) {

	$page->header();
	$page->template("feature-films/list.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
