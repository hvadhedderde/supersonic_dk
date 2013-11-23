<div class="scene i:video">

<?php

	$IC = new Item();

	$item = $IC->getItem(RESTParams(0));
	if($item) {
		$item = $IC->getCompleteItem($item["id"]);
	
	?>
	<div class="text">

		<div class="info">
			<div class="published"><?= date("Y", strtotime($item["published_at"])) ?></div>
		</div>
		<h1><?= $item["name"] ?></h1>

		<?= $item["description"] ?>

		<ul class="actions">
			<li class="watch"><a href="/videos/<?= $item["id"] ?>/video/512x288.<?= $item["video"] ?>">Watch movie</a></li>
		</ul>
	</div>
	<?
	}
?>

	<div class="video item_id:<?= $item["item_id"] ?><?= $item["screendump"] ? (" screendump:".$item["screendump"]) : "" ?>"></div>

	<ul class="actions">
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>

</div>