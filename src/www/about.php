<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("about");
$page->pageTitle("About Supersonic");


$page->page(array(
	"templates" => "about/view.php"
));
exit();

?>
