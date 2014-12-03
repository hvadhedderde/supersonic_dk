<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("music");
$page->pageTitle("Supersonic Music");


if(is_array($action) && count($action)) {

	// LIST/EDIT/NEW ITEM
	if(preg_match("/^(examples|available)$/", $action[0])) {

		$page->page(array(
			"templates" => "music/".$action[0].".php"
		));
		exit();
	}
}

$page->page(array(
	"templates" => "music/list.php"
));
exit();

?>
