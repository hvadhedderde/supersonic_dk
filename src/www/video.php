<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "video";


$page->bodyClass("video");
$page->pageTitle("Supersonic - View movie");


$page->page(array(
	"templates" => "video/view.php"
));
exit();

?>
