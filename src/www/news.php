<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "news";


$page->bodyClass("news");
$page->pageTitle("Supersonic News");


if(is_array($action) && count($action)) {

	$page->page(array(
		"templates" => "news/view.php"
	));
	exit();
}

$page->page(array(
	"templates" => "news/list.php"
));
exit();

?>
