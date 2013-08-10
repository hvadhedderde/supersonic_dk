<div class="scene i:videos">

	<?php
		$IC = new Item();
		$items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Commercials"));

		if($items) { ?>
		<div class="text">
		<?	$random = rand(0, count($items)-1);
			$item = $items[$random];
			$item = $IC->getCompleteItem($item["id"]);

			print $item["text"]; ?>
		</div>
		<? } 
	?>

	<div class="commercials">
		<h2>Selected work</h2>
		<ul class="videos">
<?php
	$IC = new Item();
	$items = $IC->getItems(array("status" => 1, "tags" => "category:Commercial", "order" => "sindex"));
	if($items) {
		foreach($items as $item) {
			$item = $IC->getCompleteItem($item["id"]);
			
			if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail")) {
				$image = "/images/".$item["id"]."/thumbnail/88x.jpg";
			}
			else {
				$image = "/img/missing_88x40.png";
			} ?>
			<li style="background-image: url(<?= $image ?>);">
				<a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a>
			</li>
<?		}
	} ?>
		</ul>
	</div>

</div>