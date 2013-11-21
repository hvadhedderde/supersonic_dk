<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$TC = new Tag();

$tags = $TC->getTags();

$page->template("admin.header.php");
?>

<h1>Tags</h1>

<ul>
<?php foreach($tags as $tag) { 
	?>

	<li><?= $tag["context"] ?>:<?= $tag["value"] ?> - <a href="/cms/tags/delete/<?= $tag["id"] ?>">delete</a></li>
<? } ?>
</ul>

<? $page->template("admin.footer.php") ?>