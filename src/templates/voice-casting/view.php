<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Voice casting"));
?>
<div class="scene i:voice">

<?		if($text_items) { ?>
		<div class="text">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>
		</div>
<? 		} ?>

	<div class="voice">


	</div>
</div>