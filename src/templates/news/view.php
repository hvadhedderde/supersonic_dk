<?php
global $action;
global $IC;
global $itemtype;

$item = $IC->getCompleteItem(array("sindex" => $action[0]));
?>
<div class="scene i:newsview">
	<div class="news">

		<div class="info">
			<div class="published"><?= date("Y - F d.", strtotime($item["published_at"])) ?></div>
		</div>
		<h2><?= $item["name"] ?></h2>
		<img src="/images/<?= $item["id"] ?>/200x90.<?= $item["files"] ?>" alt="<?= $item["name"] ?>" />

		<div class="text">
			<?= $item["text"] ?>
		</div>

	</div>

	<ul class="actions">
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>
</div>