<div class="scene i:newslist">
	<div class="news">
		<ul class="news">
<?php
	$IC = new Item();
	$items = $IC->getItems(array("itemtype" => "news", "status" => 1));

	foreach($items as $item) {
		$item = $IC->getCompleteItem($item["id"]);
		 ?>

			<li>
				<div class="info">
					<div class="published"><?= date("Y - F d.", strtotime($item["published_at"])) ?></div>
				</div>
				<h2><a href="/news/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h2>
				<img src="/images/<?= $item["id"] ?>/200x.<?= $item["files"] ?>" alt="<?= $item["name"] ?>" />
			</li>
<? 
	}
?>
		</ul>
	</div>
</div>