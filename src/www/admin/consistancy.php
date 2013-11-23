<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

// include the output class for output method support
include_once("class/system/output.class.php");

$action = $page->actions();

$IC = new Item();
$query = new Query();

// delete images
$images = $IC->getItems(array("itemtype" => "image"));
foreach($images as $image) {
	$IC->deleteItem($image["id"]);
//	print "delete image:".$image["id"]."<br>";
}
//print_r($images);

// move posters
$videos = $IC->getItems(array("itemtype" => "video"));
foreach($videos as $video) {
	if($video["id"] >= 560) {
		if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/thumbnail/jpg")) {
			FileSystem::makeDirRecursively(PRIVATE_FILE_PATH."/".$video["id"]."/poster");
			copy(PRIVATE_FILE_PATH."/".$video["id"]."/thumbnail/jpg", PRIVATE_FILE_PATH."/".$video["id"]."/poster/jpg");
			FileSystem::removeDirRecursively(PRIVATE_FILE_PATH."/".$video["id"]."/thumbnail");
			print "move thumbnail to poster:".$video["id"]."<br>";
		}
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/clip/mov")) {
		FileSystem::makeDirRecursively(PRIVATE_FILE_PATH."/".$video["id"]."/video");
		copy(PRIVATE_FILE_PATH."/".$video["id"]."/clip/mov", PRIVATE_FILE_PATH."/".$video["id"]."/video/mov");
		FileSystem::removeDirRecursively(PRIVATE_FILE_PATH."/".$video["id"]."/clip");
		print "move clip to video:".$video["id"]."<br>";
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/video/mov")) {
		$query->sql("UPDATE supersonic_dk.item_video SET video = 'mov' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET video = '' WHERE item_id = ".$video["id"]);
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/thumbnail/jpg")) {
		$query->sql("UPDATE supersonic_dk.item_video SET thumbnail = 'jpg' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET thumbnail = '' WHERE item_id = ".$video["id"]);
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/poster/jpg")) {
		$query->sql("UPDATE supersonic_dk.item_video SET poster = 'jpg' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET poster = '' WHERE item_id = ".$video["id"]);
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/screendump/jpg")) {
		$query->sql("UPDATE supersonic_dk.item_video SET screendump = 'jpg' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET screendump = '' WHERE item_id = ".$video["id"]);
	}
}
//print_r($videos);


// add format to audio
$audios = $IC->getItems(array("itemtype" => "audio"));
foreach($audios as $audio) {
	if(file_exists(PRIVATE_FILE_PATH."/".$audio["id"]."/mp3")) {
		print "add format to audio:".$audio["id"]."<br>";
		$query->sql("UPDATE supersonic_dk.item_audio SET files = 'mp3' WHERE item_id = ".$audio["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_audio SET files = '' WHERE item_id = ".$audio["id"]);
	}

}
//print_r($audios);

// add format to people
$people = $IC->getItems(array("itemtype" => "person"));
foreach($people as $person) {
	if(file_exists(PRIVATE_FILE_PATH."/".$person["id"]."/jpg")) {
		print "add format to person:".$person["id"]."<br>";
		$query->sql("UPDATE supersonic_dk.item_person SET files = 'jpg' WHERE item_id = ".$person["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_person SET files = '' WHERE item_id = ".$person["id"]);
	}
}
//print_r($people);

// add format to news
$news = $IC->getItems(array("itemtype" => "news"));
foreach($news as $new) {
	if(file_exists(PRIVATE_FILE_PATH."/".$new["id"]."/jpg")) {
		print "add format to news:".$new["id"]."<br>";
		$query->sql("UPDATE supersonic_dk.item_news SET files = 'jpg' WHERE item_id = ".$new["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_news SET files = '' WHERE item_id = ".$new["id"]);
	}
}
//print_r($news);



?>
