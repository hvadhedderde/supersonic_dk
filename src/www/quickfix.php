<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


include_once("classes/system/upgrade.class.php");

$upgrade = new Upgrade();

$upgrade->moveFilesColumnToItems("news", "main");
$upgrade->moveFilesColumnToItems("person", "main");
$upgrade->moveFilesColumnToItems("audio", "main");

$upgrade->moveFilesColumnToItems("video", "video", "video");
$upgrade->moveFilesColumnToItems("video", "screendump", "screendump");
$upgrade->moveFilesColumnToItems("video", "thumbnail", "thumbnail");
$upgrade->moveFilesColumnToItems("video", "poster", "poster");

?>