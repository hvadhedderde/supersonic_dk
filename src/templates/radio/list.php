<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Radio"));
$items = $IC->getItems(array("itemtype" => "audio", "status" => 1, "tags" => "category:Radio", "order" => "sindex", "extend" => array("mediae" => true)));
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

	<div class="radio">

		<div class="listen">
			<h2>Listen to selected work</h2>
			<ul class="audio">
<?			if($items):
				foreach($items as $i => $item):
					if($i != 0 && $i%ceil(count($items)/2) == 0) { ?>
						</ul>
						<ul class="audio">
<?					}
					$media = $IC->sliceMedia($item, "main"); ?>
					<li class=""><a href="/audios/<?= $item["id"] ?>/main/128.mp3" rel="nofollow"><?= $item["name"] ?></a></li>
<?				endforeach; ?>
<?			endif; ?>
			</ul>
		</div>

	</div>
</div>

