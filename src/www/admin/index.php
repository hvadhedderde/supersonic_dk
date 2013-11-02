<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["LOCAL_PATH"]."/config/config.php");

$action = $page->access();

$page->template("admin.header.php");
?>


<? $page->template("admin.footer.php") ?>