<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../config/config.php");

$action = $page->access();



// domain/cms/save/{itemtype} + POST
// domain/cms/save/text + POST

// domain/cms/update/{item_id} + POST

// domain/cms/delete/{item_id}

// domain/cms/tags/add/{item_id} + POST
// domain/cms/tags/delete/{item_id}/{tag_id}

if(isset($action) && count($action) > 1 && $action[0] == "save") {

	$IC = new Item();
	if($IC->saveItem()) {
		
	}
	else {

	}

}
else if(isset($action) && count($action) > 1 && $action[0] == "update") {

	$IC = new Item();
	if($IC->updateItem($action[1])) {

	}
	else {

	}

}
else if(isset($action) && count($action) > 1 && $action[0] == "delete") {

	$IC = new Item();
	if($IC->deleteItem($action[1])) {

	}
	else {

	}

}
else if(isset($action) && count($action) > 2 && $action[0] == "tags" && $action[1] == "add") {

	$IC = new Item();
	if($IC->addTag($action[2], getPost("tag"))) {

	}
	else {

	}

}
else if(isset($action) && count($action) > 3 && $action[0] == "tags" && $action[1] == "delete") {

	$IC = new Item();
	if($IC->deleteTag($action[2], $action[3])) {

	}
	else {

	}

}
else {

	$page->header();
	$page->template("404.php");
	$page->footer();

}

?>
