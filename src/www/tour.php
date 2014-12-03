<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("tour");
$page->pageTitle("Supersonic Tour");


$page->page(array(
	"templates" => "tour/list.php"
));
exit();

?>
