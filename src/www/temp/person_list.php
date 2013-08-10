<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$items = $IC->getItems(array("itemtype" => "person"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>People</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>People</h1>

<ul>
<?php foreach($items as $item) { 
	$item = $IC->getCompleteItem($item["id"]);
	?>
	<li>
		<a href="/temp/person_edit/<?= $item["id"] ?>"><?= $item["name"] ?></a>
		<?
		if($item["tags"]) {
			print '<ul class="tags">';
			foreach($item["tags"] as $tag) {
				print '<li>'.$tag["context"].":".$tag["value"].'</li>';
			}
			print '</ul>';
		}	
		?>
		<ul class="actions">
			<li class="delete"><a href="/cms/delete/<?= $item["id"] ?>">delete</a></li>
			<li class="status"><?= ($item["status"] ? ('<a href="/cms/disable/'.$item["id"].'">disable</a>') : '<a href="/cms/enable/'.$item["id"].'">enable</a>') ?></li>
		</ul>
	</li>
<? } ?>
</ul>

<? $page->template("admin.footer.php") ?>