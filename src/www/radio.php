<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("radio");
$page->pageTitle("Supersonic Radio");


$page->page(array(
	"templates" => "radio/list.php"
));
exit();

?>
