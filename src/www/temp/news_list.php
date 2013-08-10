<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$items = $IC->getItems(array("itemtype" => "news"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>News</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>News</h1>

<ul>
<?php foreach($items as $item) { 
	$item = $IC->getCompleteItem($item["id"]);
	?>
	<li><a href="/temp/news_edit/<?= $item["id"] ?>"><?= $item["name"] ?></a> - <?= $item["status"] ?> - <a href="/cms/delete/<?= $item["id"] ?>">delete</a></li>
<? } ?>
</ul>


</body>
</html>