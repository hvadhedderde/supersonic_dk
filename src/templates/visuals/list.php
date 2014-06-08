<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Visuals"));
$items = $IC->getItems(array("itemtype" => "video", "status" => 1, "tags" => "category:Visual", "order" => "sindex"));
?>
<div class="scene i:videos">

<?		if($text_items) { ?>
		<div class="text">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["text"]; ?>
		</div>
<? 		} ?>

	<div class="visuals">
		<h2>Selected work</h2>
		<ul class="videos">
<?	if($items) {
		foreach($items as $item) {
			$item = $IC->extendItem($item);

			if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail/".$item["thumbnail"])) {
				$image = "/images/".$item["id"]."/thumbnail/88x.".$item["thumbnail"];
			}
			else {
				$image = "/images/0/missing/88x40.png";
			} ?>
			<li style="background-image: url(<?= $image ?>);">
				<a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a>
			</li>
<?		} ?>
<?	} ?>
		</ul>
	</div>

</div>