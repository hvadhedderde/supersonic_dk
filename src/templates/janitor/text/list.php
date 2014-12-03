<?php
global $action;
global $IC;
global $itemtype;

$all_items = $IC->getItems(array("itemtype" => $itemtype, "order" => "status DESC", "extend" => array("tags" => true)));
?>
<div class="scene defaultList <?= $itemtype ?>List">
	<h1>Texts</h1>

	<ul class="actions">
		<?= $JML->listNew(array("label" => "New text")) ?>
	</ul>

	<div class="all_items i:defaultList taggable filters"<?= $JML->jsData() ?>>
<?		if($all_items): ?>
		<ul class="items">
<?			foreach($all_items as $item): ?>
			<li class="item item_id:<?= $item["id"] ?>">
				<h3><?= $item["name"] ?></h3>


				<?= $JML->tagList($item["tags"]) ?>

				<?= $JML->listActions($item) ?>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No text items.</p>
<?		endif; ?>
	</div>

</div>
