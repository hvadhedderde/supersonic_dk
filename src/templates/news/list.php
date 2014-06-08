<?php
global $action;
global $IC;
global $itemtype;

$items = $IC->getItems(array("itemtype" => $itemtype, "status" => 1));
?>
<div class="scene i:newslist">
	<div class="news">
		<ul class="news">
<?			foreach($items as $item):
				$item = $IC->extendItem($item); ?>
			<li>
				<div class="info">
					<div class="published"><?= date("Y - F d.", strtotime($item["published_at"])) ?></div>
				</div>
				<h2><a href="/news/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h2>
				<img src="/images/<?= $item["id"] ?>/200x.<?= $item["files"] ?>" alt="<?= $item["name"] ?>" />
			</li>
<? 			endforeach; ?>
		</ul>
	</div>
</div>