<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Visuals"));
$items = $IC->getItems(array("itemtype" => "video", "status" => 1, "tags" => "category:Visual", "order" => "sindex", "extend" => array("mediae" => true)));
?>
<div class="scene i:videos">

<?		if($text_items) { ?>
		<div class="text articlebody">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>
		</div>
<? 		} ?>

	<div class="visuals">
		<h2>Selected work</h2>
		<ul class="videos">
<?	if($items) {
		foreach($items as $item) {
			$media = $IC->sliceMedia($item, "thumbnail");

			if($media && file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail/".$media["format"])) {
				$image = "/images/".$item["id"]."/thumbnail/88x.".$media["format"];
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