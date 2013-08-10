<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$TC = new Tag();

$tags = $TC->getTags();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Tags</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<h1>Tags</h1>

<ul>
<?php foreach($tags as $tag) { 
	?>

	<li><?= $tag["context"] ?>:<?= $tag["value"] ?> - <a href="/cms/tags/delete/<?= $tag["id"] ?>">delete</a></li>
<? } ?>
</ul>


</body>
</html>