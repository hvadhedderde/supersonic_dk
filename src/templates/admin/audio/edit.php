<?php

$action = $this->actions();

$IC = new Item();
$model = $IC->typeObject("audio");

$item = $IC->getCompleteItem($action[1]);
$item_id = $item["id"];
?>
<div class="scene defaultEdit">
	<h1>Edit audio</h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/audio/list" class="button">Back</a></li>
	</ul>

	<div class="item">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formDefaultEdit labelstyle:inject" method="post" enctype="multipart/form-data">

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/audio/list" class="button key:esc">Back</a></li>
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

	<h2>Audio</h2>
	<div class="audios">
		<form action="/admin/cms/update/<?= $item_id ?>" class="i:formAddImages labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add audio" class="button primary" /></li>
			</ul>

		</form>

		<ul class="audios">
<?		if($item["files"]): ?>
			<li class="audio i:audio"><a href="/audios/<?= $item_id ?>/128.<?= $item["files"] ?>">Audio</a></li>
<?		else: ?>
			<li class="audio">No audio file</li>
<?		endif; ?>
		</ul>

	</div>

</div>