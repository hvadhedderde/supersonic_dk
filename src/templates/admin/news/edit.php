<?php

$action = $this->actions();

$IC = new Item();
$itemtype = "news";

$model = $IC->typeObject($itemtype);

$item = $IC->getCompleteItem($action[1]);
$item_id = $item["id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit <?= $itemtype ?></h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button">Back</a></li>
	</ul>

	<div class="item i:defaultEdit">
		<form action="/admin/cms/update/<?= $item_id ?>" class="labelstyle:inject" method="post" enctype="multipart/form-data">

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("text", array("class" => "autoexpand", "value" => $item["text"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button key:esc">Back</a></li>
				<li class="save"><input type="submit" value="Update" class="button primary key:s" /></li>
			</ul>

		</form>
	</div>

	<h2>Tags</h2>
	<div class="tags i:defaultTags item_id:<?= $item_id ?>">
		<form action="/admin/cms/update/<?= $item_id ?>" class="labelstyle:inject" method="post" enctype="multipart/form-data">
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
				<span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span>

				<!--form action="/admin/cms/tags/delete/<?= $item_id ?>/<?= $tag["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
					<input type="submit" value="Delete" class="delete" />
				</form-->
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>
	</div>

	<h2>Media</h2>
	<div class="media i:addMedia">
		<p>Image must be 200x90 pixels, jpg or png.</p>

		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formAddMedia labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add image" class="button primary" /></li>
			</ul>

		</form>

		<ul class="media">
			<li class="image">
				<h4>Image</h4>
<?		if($item["files"]): ?>
				<img src="/images/<?= $item["id"] ?>/160x72.<?= $item["files"] ?>">
<?		else: ?>
				<img src="/images/0/missing/160x72.png">
<?		endif; ?>
			</li>
		</ul>

	</div>

</div>