<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

// include the output class for output method support
include_once("class/system/output.class.php");

$action = $page->actions();

$page->pageTitle("the Janitor @ Supersonic")
?>
<? $page->header(array("type" => "admin")) ?>

<div class="scene front">
	<h1>Supersonic Admin</h1>
</div>

<? $page->footer(array("type" => "admin")) ?>