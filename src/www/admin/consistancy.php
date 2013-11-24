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
// $images = $IC->getItems(array("itemtype" => "image"));
// foreach($images as $image) {
// 	$IC->deleteItem($image["id"]);
// //	print "delete image:".$image["id"]."<br>";
// }
//print_r($images);

// move posters
$videos = $IC->getItems(array("itemtype" => "video"));
//print_r($videos);
foreach($videos as $video) {
	if($video["id"] >= 560 && $video["id"] <= 573) {
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
	else if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/thumbnail/png")) {
		$query->sql("UPDATE supersonic_dk.item_video SET thumbnail = 'png' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET thumbnail = '' WHERE item_id = ".$video["id"]);
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/poster/jpg")) {
		$query->sql("UPDATE supersonic_dk.item_video SET poster = 'jpg' WHERE item_id = ".$video["id"]);
	}
	else if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/poster/png")) {
		$query->sql("UPDATE supersonic_dk.item_video SET poster = 'png' WHERE item_id = ".$video["id"]);
	}
	else {
		$query->sql("UPDATE supersonic_dk.item_video SET poster = '' WHERE item_id = ".$video["id"]);
	}

	if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/screendump/jpg")) {
		$query->sql("UPDATE supersonic_dk.item_video SET screendump = 'jpg' WHERE item_id = ".$video["id"]);
	}
	else if(file_exists(PRIVATE_FILE_PATH."/".$video["id"]."/screendump/png")) {
		$query->sql("UPDATE supersonic_dk.item_video SET screendump = 'png' WHERE item_id = ".$video["id"]);
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

// $sets = $IC->getItems(array("itemtype" => "set"));
// foreach($sets as $set) {
// 	$IC->deleteItem($set["id"]);
// }
// //print_r($news);



// check file consitancy
$items = $IC->getItems();
foreach($items as $item) {
//	print $item["id"]."<br>";
	if($item["itemtype"] == "set" || $item["itemtype"] == "image") {
		$IC->deleteItem($item["id"]);
	}
	else {
		$item = $IC->getCompleteItem($item["id"]);
		if($item["itemtype"] == "video") {
			if($item["thumbnail"]) {
				if(!file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail/".$item["thumbnail"])) {
					print "missing thumbnail file: ".$item["thumbnail"]."<br>";
				}
			}
			if($item["poster"]) {
				if(!file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/poster/".$item["poster"])) {
					print "missing poster file: ".$item["poster"]."<br>";
				}
			}
			if($item["screendump"]) {
				if(!file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/screendump/".$item["screendump"])) {
					print "missing screendump file: ".$item["screendump"]."<br>";
				}
			}
			if($item["video"]) {
				if(!file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/video/".$item["video"])) {
					print "missing video file: ".$item["video"]."<br>";
				}
			}
		
		}
		else if(isset($item["files"])) {
			if(!file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/".$item["files"])) {
				print "missing file<br>";
			}
		}
	}

}

print "check filesystem<br>";

$query = new Query();
$files = FileSystem::files(PRIVATE_FILE_PATH);

//print_r($files);
foreach($files as $file) {
//	print $file."<br>";

	preg_match("/\/([0-9]+)/", str_replace(PRIVATE_FILE_PATH, "", $file), $matches);
//	print_r($matches);
// 
	if(count($matches)) {

		if($matches[1] !== "0") {
// 
//			print $file."<br>";

			if($query->sql("SELECT id, itemtype, status FROM ".UT_ITEMS." WHERE id = ".$matches[1])) {

				$id = $query->result(0, "id");
				$itemtype = $query->result(0, "itemtype");
				$status = $query->result(0, "status");

	//			print $itemtype."<br>";

				if($itemtype == "video") {

					$query->sql("SELECT thumbnail,poster,screendump,video FROM supersonic_dk.item_".$itemtype." WHERE item_id = ".$matches[1]);
					if(preg_match("/thumbnail/", $file)) {
						$thumbnail = $query->result(0, "thumbnail");
						if(str_replace(PRIVATE_FILE_PATH."/".$matches[1]."/thumbnail/".$thumbnail, "", $file) != "") {
							print "wrong thumbnail filetype:".$thumbnail.", ".$matches[1].", ".$file."<br>";
						}
					}
					if(preg_match("/poster/", $file)) {
						$poster = $query->result(0, "poster");
						if(str_replace(PRIVATE_FILE_PATH."/".$matches[1]."/poster/".$poster, "", $file) != "") {
							print "wrong poster filetype:".$poster.", ".$matches[1].", ".$file."<br>";
						}
					}
					if(preg_match("/screendump/", $file)) {
						$screendump = $query->result(0, "screendump");
						if(str_replace(PRIVATE_FILE_PATH."/".$matches[1]."/screendump/".$screendump, "", $file) != "") {
							print "wrong screendump filetype:".$screendump.", ".$matches[1].", ".$file."<br>";
						}
					}
					if(preg_match("/video/", $file)) {
						$video = $query->result(0, "video");
						if(str_replace(PRIVATE_FILE_PATH."/".$matches[1]."/video/".$video, "", $file) != "") {
							print "wrong video filetype:".$video.", ".$matches[1].", ".$file."<br>";
						}
					}
				}
				else if($itemtype == "text") {
					print "text with image???<br>";
				}
				// type with files
				else {
					$query->sql("SELECT files FROM supersonic_dk.item_".$itemtype." WHERE item_id = ".$matches[1]);
					$file_type = $query->result(0, "files");
					if(str_replace(PRIVATE_FILE_PATH."/".$matches[1]."/".$file_type, "", $file) != "") {
						print "wrong filetype:".$file_type."<br>";
					}
				}

			}
			// item not found
			else {
// 			print_r($matches);
				print "ITEM NOT FOUND: " . $matches[1] . ", " . $file . " - DELETED<br>";
				// delete
				FileSystem::removeDirRecursively(PRIVATE_FILE_PATH."/".$matches[1]);
			}
		}
	}
	else {
		print "unidentified object:" . $file . "<br>";
	}
}


?>
