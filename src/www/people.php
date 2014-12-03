<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "person";


$page->bodyClass("people");
$page->pageTitle("Supersonic People");

if(is_array($action) && count($action)) {

	$page->page(array(
		"templates" => "people/view.php"
	));
	exit();
}

$page->page(array(
	"templates" => "people/list.php"
));
exit();

?>
