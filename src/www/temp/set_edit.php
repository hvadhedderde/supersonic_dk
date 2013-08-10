<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$item = $IC->getCompleteItem($action[0]);

$item["tags"] = $IC->getTags($action[0]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Set</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>Set</h1>
<form action="/cms/update/<?= $action[0] ?>" method="post">

	<div class="field">
		<label>Name</label>
		<input type="text" name="name" value="<?= $item["name"]?>" />
	</div>


	<ul class="actions">
		<li><input type="submit" value="update" /></li>
	</ul>

</form>

<h1>Tags</h1>
<ul>
<?php if($item["tags"]) {
	foreach($item["tags"] as $index => $tag) { ?>
		<li><?= $tag["context"].":".$tag["value"] ?> - <a href="/cms/tags/delete/<?= $action[0] ?>/<?= $tag["id"] ?>">delete</a></li>
	<? }
} ?>
</ul>

<form action="/cms/tags/add/<?= $action[0] ?>" method="post">

	<div class="field">
		<label>Add Tag</label>
		<input type="text" name="tag" value="" />
	</div>

	<ul class="actions">
		<li><input type="submit" value="Add" /></li>
	</ul>

</form>


</body>
</html>