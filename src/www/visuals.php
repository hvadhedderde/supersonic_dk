<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();
$IC = new Item();


$page->bodyClass("visual");
$page->pageTitle("Supersonic Visuals");

// list
if(!$action) {

	$page->header();
	$page->template("visuals/list.php");
	$page->footer();

}
// view - check for id
else if(isset($action[0])) {

	$page->header();
	$page->template("video/view.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
