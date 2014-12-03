<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("commercial");
$page->pageTitle("Supersonic Commercials");


// if(is_array($action) && count($action)) {
//
// 	if(count($action) == 1) {
//
// 		$page->page(array(
// 			"templates" => "video/view.php"
// 		));
// 		exit();
// 	}
//
// }

$page->page(array(
	"templates" => "commercials/list.php"
));
exit();

?>
