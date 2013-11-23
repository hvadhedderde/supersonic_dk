<?php

$action = $this->actions();

$IC = new Item();
$itemtype = "video";
$model = $IC->typeObject($itemtype);

$item = $IC->getCompleteItem($action[1]);
$item_id = $item["id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit <?= $itemtype ?></h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button">Back</a></li>
	</ul>

	<div class="item">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formDefaultEdit labelstyle:inject" method="post" enctype="multipart/form-data">

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button key:esc">Back</a></li>
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

	<h2>Media</h2>
	<div class="media">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formAddImages labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add image" class="button primary" /></li>
			</ul>

		</form>

		<ul class="media">
			<li class="image">
				<h4>thumbnail</h4>
<?		if($item["thumbnail"]): ?>
				<img src="/images/<?= $item["id"] ?>/thumbnail/88x.<?= $item["thumbnail"] ?>">
<?		else: ?>
				<img src="/images/0/missing/88x40.png">
<?		endif; ?>
			</li>

			<li class="image">
				<h4>screendump</h4>
<?		if($item["screendump"]): ?>
				<img src="/images/<?= $item["id"] ?>/screendump/x100.<?= $item["screendump"] ?>">
<?		else: ?>
				<img src="/images/0/missing/177x100.png">
<?		endif; ?>
			</li>

			<li class="image">
				<h4>poster</h4>
<?		if($item["poster"]): ?>
				<img src="/images/<?= $item["id"] ?>/poster/x100.<?= $item["poster"] ?>">
<?		else: ?>
				<img src="/images/0/missing/75x100.png">
<?		endif; ?>
			</li>

			<li class="video">
				<h4>video</h4>
<?		if($item["video"]): ?>
				<a href="/videos/<?= $item["id"] ?>/video/x100.<?= $item["video"] ?>">video</a>
<?		else: ?>
				<img src="/images/0/missing/177x100.png">
<?		endif; ?>
			</li>
		</ul>

	</div>

</div>
