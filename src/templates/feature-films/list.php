<?php
$IC = new Item();

$items = $IC->getItems(array("status" => 1, "itemtype" => "video", "tags" => "category:Feature films"));
?>
<div class="scene i:posters">
	<div class="films">

		<h1>Feature Films</h1>
		<ul class="posters">
<?			if($items): ?>
<?				foreach($items as $item):
					$item = $IC->extendItem($item); ?>
<?
					if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/poster/".$item["poster"])) {
						$image = "/images/".$item["id"]."/poster/240x.".$item["poster"];
					}
					else {
						$image = "/images/0/missing/240x320.png";
					}
?>
			<li style="background-image: url(<?= $image ?>);">
				<h2><a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h2>
			</li>
<?				endforeach; ?>
<?			endif; ?>
		</ul>
	</div>
</div>