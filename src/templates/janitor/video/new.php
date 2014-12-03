<?php
global $action;
global $IC;
global $itemtype;
global $model;
?>
<div class="scene defaultNew <?= $itemtype ?>New">
	<h1>New <?= $itemtype ?></h1>

	<ul class="actions">
		<?= $JML->newList(array("label" => "List")) ?>
	</ul>

	<?= $model->formStart("save", array("class" => "i:defaultNew labelstyle:inject")) ?>
		<fieldset>
			<?= $model->input("published_at") ?>
			<?= $model->input("name") ?>
		</fieldset>

		<?= $JML->newActions() ?>
		<p>After you save, you can add your files.</p>
	<?= $model->formEnd() ?>

</div>
