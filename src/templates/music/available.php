<div class="scene i:audio">

	<?php
		$IC = new Item();
		$items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Available Music"));

		if($items) { ?>
		<div class="text">
		<?	$random = rand(0, count($items)-1);
			$item = $items[$random];
			$item = $IC->getCompleteItem($item["id"]);

			print $item["text"]; ?>
		</div>
		<? } 
	?>

	<div class="music available">

		<div class="category">
			<h2>Tunes</h2>
			<ul class="audio">
			<?
				$items = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Tunes"));
				// $items = $IC->getSetItems("Tunes");
				if($items) {
					foreach($items as $item) {
						$item = $IC->getCompleteItem($item["id"]);
						 ?>
				<li class=""><a href="/audios/<?= $item["id"] ?>/128.mp3"><?= $item["name"] ?></a></li>
			<?		}
				}
			?>
			</ul>
		</div>

		<div class="category">
			<h2>Jingles</h2>
			<ul class="audio">
			<?
				$items = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Jingles"));
				//$items = $IC->getSetItems("Jingles");
				if($items) {
					foreach($items as $item) {
						$item = $IC->getCompleteItem($item["id"]);
						 ?>
				<li class=""><a href="/audios/<?= $item["id"] ?>/128.mp3"><?= $item["name"] ?></a></li>
			<?		}
				}
			?>
			</ul>
		</div>



	</div>

	<ul class="actions">
		<li class="back"><a href="/music">Back</a></li>
	</ul>

</div>