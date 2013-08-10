<div class="scene i:audio">

	<?php
		$IC = new Item();
		$items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Radio"));

		if($items) { ?>
		<div class="text">
		<?	$random = rand(0, count($items)-1);
			$item = $items[$random];
			$item = $IC->getCompleteItem($item["id"]);

			print $item["text"]; ?>
		</div>
		<? } 
	?>

	<div class="radio">

		<div class="listen">
			<h2>Listen to selected work</h2>
			<ul class="audio">
			<?
				//$items = $IC->getSetItems("Radio");
				$items = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Radio"));
				if($items) {
					foreach($items as $item) {
						$item = $IC->getCompleteItem($item["id"]); ?>
				<li class=""><a href="/audios/<?= $item["id"] ?>/128.mp3"><?= $item["name"] ?></a></li>
			<?		}
				}
			?>
			</ul>
		</div>

	</div>
</div>

