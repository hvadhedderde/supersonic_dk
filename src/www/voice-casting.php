<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();


$page->bodyClass("voice");
$page->pageTitle("Supersonic Voice Casting");

// list
if(!$action) {

	$page->header();
	$page->template("voice-casting/view.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
