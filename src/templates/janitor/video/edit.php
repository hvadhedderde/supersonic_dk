<?php
global $action;
global $IC;
global $itemtype;
global $model;

$item = $IC->getItem(array("id" => $action[1], "extend" => array("tags" => true, "mediae" => true)));
$item_id = $item["id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit <?= $itemtype ?></h1>

	<?= $JML->editGlobalActions($item) ?>

	<div class="item i:defaultEdit item_id:<?= $item_id ?>">
		<h2>Video details</h2>
		<?= $model->formStart("/janitor/admin/items/update/".$item_id, array("class" => "labelstyle:inject")) ?>

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->inputHTML("html", array("value" => $item["html"])) ?>
			</fieldset>

			<?= $JML->editActions($item) ?>

		<?= $model->formEnd() ?>
	</div>


	<?= $JML->editTags($item) ?>


	<?= $JML->editMedia($item, array("type" => "variant")) ?>

</div>
