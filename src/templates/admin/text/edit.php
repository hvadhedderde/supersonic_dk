<?php

$action = $this->actions();

$IC = new Item();
$itemtype = "text";
$model = $IC->typeObject("text");

$item = $IC->getCompleteItem($action[1]);
$item_id = $item["id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit <?= $itemtype ?></h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/ <?= $itemtype ?>Edit/list" class="button">Back</a></li>
	</ul>

	<div class="item">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formDefaultEdit labelstyle:inject" method="post" enctype="multipart/form-data">

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("text", array("class" => "autoexpand", "value" => $item["text"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/ <?= $itemtype ?>Edit/list" class="button key:esc">Back</a></li>
				<li class="save"><input type="submit" value="Update" class="button primary key:s" /></li>
			</ul>

		</form>
	</div>

	<h2>Tags</h2>
	<div class="tags i:defaultTags">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formAddTags labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("tags") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add tag" class="button primary" /></li>
			</ul>
		</form>

		<ul class="tags">
<?		if($item["tags"]): ?>
<?			foreach($item["tags"] as $index => $tag): ?>
			<li class="tag">
				<h3><span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span></h3>
				<form action="/admin/cms/tags/delete/<?= $item_id ?>/<?= $tag["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
					<input type="submit" value="Delete" class="delete" />
				</form>
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>
	</div>

</div>