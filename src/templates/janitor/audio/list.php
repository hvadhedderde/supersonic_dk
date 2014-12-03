<?php
global $action;
global $IC;
global $itemtype;

$items = $IC->getItems(array("itemtype" => $itemtype, "order" => "status DESC", "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene defaultList <?= $itemtype ?>List">
	<h1>Audio</h1>

	<ul class="actions">
		<?= $JML->listNew(array("label" => "New audio")) ?>
	</ul>

	<div class="all_items i:defaultList taggable filters"<?= $JML->jsData() ?>>
<?		if($items): ?>
		<ul class="items">
<?			foreach($items as $item): ?>
			<li class="item audio item_id:<?= $item["id"] ?> format:<?= $item["mediae"]["main"]["format"] ?> variant:<?= $item["mediae"]["main"]["variant"] ?>">
				<h3><?= $item["name"] ?></h3>


				<?= $JML->tagList($item["tags"]) ?>

				<?= $JML->listActions($item) ?>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No audio items.</p>
<?		endif; ?>
	</div>

</div>
