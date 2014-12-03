<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();
$IC = new Items();


$page->bodyClass("tv");
$page->pageTitle("Supersonic TV & Documentary");

// list
if(!$action) {

	$page->header();
	$page->template("tv-and-documentary/list.php");
	$page->footer();

}
// view - check for id
else if($action[0] == "view" && isset($action[1])) {

	$page->header();
	$page->template("tv-and-documentary/view.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
