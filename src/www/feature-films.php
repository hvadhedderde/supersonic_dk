<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["LOCAL_PATH"]."/config/config.php");

$action = $page->access();


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
