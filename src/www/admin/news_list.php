<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$items = $IC->getItems(array("itemtype" => "news"));

$page->template("admin.header.php");
?>

<h1>News list</h1>

<ul class="actions">
	<li class="new"><a href="/temp/news_new">New news</a></li>
</ul>

<ul>
<?php foreach($items as $item) { 
	$item = $IC->getCompleteItem($item["id"]);
	$item["tags"] = $IC->getTags($item["id"]);
	?>
	<li>
		<a href="/temp/news_edit/<?= $item["id"] ?>"><?= $item["name"] ?></a>
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