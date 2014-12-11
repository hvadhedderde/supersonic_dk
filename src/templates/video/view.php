<?php
global $action;
global $IC;
global $itemtype;

$item = $IC->getItem(array("sindex" => $action[0], "extend" => array("mediae" => true)));
$video = $IC->sliceMedia($item, "video");
$screendump = $IC->sliceMedia($item, "screendump");
?>
<div class="scene i:video">

	<div class="text">

		<div class="info">
			<div class="published"><?= date("Y", strtotime($item["published_at"])) ?></div>
		</div>
		<h1><?= $item["name"] ?></h1>

		<div class="articlebody">
			<?= $item["html"] ?>
		</div>

<?		if($video): ?>
		<ul class="actions">
			<li class="watch"><a href="/videos/<?= $item["id"] ?>/video/512x288.mp4" rel="nofollow">Watch movie</a></li>
		</ul>
<?		endif; ?>
	</div>

<?	if($video): ?>
	<div class="video item_id:<?= $item["id"] ?><?= $screendump ? (" screendump:".$screendump["format"]) : "" ?>"></div>
<?	endif; ?>

	<ul class="actions">
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>

</div>