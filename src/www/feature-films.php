<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("film");
$page->pageTitle("Supersonic Feature Films");


$page->page(array(
	"templates" => "feature-films/list.php"
));
exit();

?>
