<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();


$page->bodyClass("music");
$page->pageTitle("Supersonic Music");

// list
if(!$action) {

	$page->header();
	$page->template("music/list.php");
	$page->footer();

}
// examples
else if(isset($action[0]) && $action[0] == "examples") {

	$page->header();
	$page->template("music/examples.php");
	$page->footer();

}
// available
else if(isset($action[0]) && $action[0] == "available") {

	$page->header();
	$page->template("music/available.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
