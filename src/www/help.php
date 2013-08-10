<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../config/config.php");

$action = $page->access();


$page->bodyClass("help");
$page->pageTitle("Supersonic Website Help");

// list
if(!$action) {

	$page->header();
	$page->template("help/view.php");
	$page->footer();

}
// restructure - check for id
else if($action[0] == "restructure") {

	$page->header();
	$page->template("restructure.php");
	$page->footer();

}
// rename - check for id
else if($action[0] == "rename") {

	$page->header();
	$page->template("rename.php");
	$page->footer();

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
