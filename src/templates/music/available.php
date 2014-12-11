<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Available music"));
$items_tunes = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Tunes"));
$items_jingles = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Jingles"));
?>
<div class="scene i:audio">

<?		if($text_items) { ?>
		<div class="text articlebody">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>
		</div>
<? 		} ?>

	<div class="music available">

		<div class="category">
			<h2>Tunes</h2>
			<ul class="audio">
<?			if($items_tunes) {
				foreach($items_tunes as $item) {
					$item = $IC->extendItem($item); ?>
				<li class=""><a href="/audios/<?= $item["id"] ?>/main/128.mp3" rel="nofollow"><?= $item["name"] ?></a></li>
<?			} ?>
<?		} ?>
			</ul>
		</div>

		<div class="category">
			<h2>Jingles</h2>
			<ul class="audio">
<?			if($items_jingles) {
				foreach($items_jingles as $item) {
					$item = $IC->extendItem($item); ?>
				<li class=""><a href="/audios/<?= $item["id"] ?>/main/128.mp3" rel="nofollow"><?= $item["name"] ?></a></li>
<?			} ?>
<?		} ?>
			</ul>
		</div>



	</div>

	<ul class="actions">
		<li class="back"><a href="/music">Back</a></li>
	</ul>

</div>