<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$items = $IC->getItems(array("itemtype" => "video"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Video</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>Video</h1>

<ul>
<?php foreach($items as $item) { 
	$item = $IC->getCompleteItem($item["id"]);
	print_r($item);
	?>
	<li>
		<a href="/temp/video_edit/<?= $item["id"] ?>"><?= $item["name"] ?></a>
		<?
		print_r($item["tags"]);
		if($item["tags"]) {
			
		}	
		?>
		<ul class="tags">
		</ul>
		<ul class="actions">
			<li class="delete"><a href="/cms/delete/<?= $item["id"] ?>">delete</a></li>
			<li class="status"><?= ($item["status"] ? ('<a href="/cms/disable/'.$item["id"].'">disable</a>') : '<a href="/cms/enable/'.$item["id"].'">enable</a>') ?></li>
		</ul>
	</li>
<? } ?>
</ul>


</body>
</html>