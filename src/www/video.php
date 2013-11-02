<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();


$page->bodyClass("video");
$page->pageTitle("Supersonic - View movie");

// list
// view - check for id
if(isset($action[0])) {

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
