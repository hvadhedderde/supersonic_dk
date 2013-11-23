<div class="scene i:videos">

	<?php
		$IC = new Item();
		$items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Music Examples"));

		if($items) { ?>
		<div class="text">
		<?	$random = rand(0, count($items)-1);
			$item = $items[$random];
			$item = $IC->getCompleteItem($item["id"]);

			print $item["text"]; ?>
		</div>
		<? } 
	?>

	<div class="music examples">
		<h2>Watch selected work</h2>
		<ul class="videos">
<?php
	$IC = new Item();
	$items = $IC->getItems(array("itemtype" => "video", "status" => 1, "tags" => "category:Music", "order" => "sindex"));
	if($items) {
		foreach($items as $item) {
			$item = $IC->getCompleteItem($item["id"]);

			if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail/".$item["thumbnail"])) {
				$image = "/images/".$item["id"]."/thumbnail/88x.".$item["thumbnail"];
			}
			else {
				$image = "/images/0/missing/88x40.png";
			} ?>
			<li style="background-image: url(<?= $image ?>);">
				<a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a>
			</li>
<?		}
	}
?>
		</ul>
	</div>

	<ul class="actions">
		<li class="back"><a href="/music">Back</a></li>
	</ul>

</div>