<?php
global $action;
global $IC;
global $itemtype;
global $model;

$item = $IC->getCompleteItem(array("id" => $action[1]));
$item_id = $item["id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit <?= $itemtype ?></h1>

	<ul class="actions">
		<?= $HTML->link("Back", "/admin/".$itemtype."/list", array("class" => "button", "wrapper" => "li.cancel")) ?>
	</ul>

	<div class="status i:defaultEditStatus item_id:<?= $item["id"] ?>">
		<ul class="actions">
			<?= $HTML->status("Enable", "Disable", "/admin/cms/status", $item, array("js" => true)) ?>
		</ul>
	</div>

	<div class="item i:defaultEdit item_id:<?= $item_id ?>">
		<?= $model->formStart("/admin/cms/update/".$item_id, array("class" => "labelstyle:inject")) ?>

			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
			</fieldset>

			<ul class="actions">
				<?= $model->link("Back", "/admin/".$itemtype."/list", array("class" => "button key:esc", "wrapper" => "li.cancel")) ?>
				<?= $model->submit("Update", array("class" => "primary key:s", "wrapper" => "li.save")) ?>
			</ul>

		<?= $model->formEnd() ?>
	</div>

	<h2>Tags</h2>
	<div class="tags i:defaultTags item_id:<?= $item_id ?>">
		<?= $model->formStart("/admin/cms/update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("tags") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add tag", array("class" => "primary", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>

		<ul class="tags">
<?		if($item["tags"]): ?>
<?			foreach($item["tags"] as $index => $tag): ?>
			<li class="tag">
				<span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span>
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>
	</div>

	<h2>Audio</h2>
	<div class="media i:addMedia">
		<p>Audio must be mp3.</p>
		<?= $model->formStart("/admin/cms/update/".$item_id, array("class" => "upload labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add audio", array("class" => "primary", "wrapper" => "li.save")) ?>
			</ul>

		<?= $model->formEnd() ?>

		<ul class="media">
			<li class="audio<?= $item["files"] ? " i:audio" : "" ?>">
				<h4>Audio</h4>
<?		if($item["files"]): ?>
				<a href="/audios/<?= $item_id ?>/128.<?= $item["files"] ?>">Audio</a>
<?		else: ?>
				<img src="/images/0/missing/50x50.png">
<?		endif; ?>
			</li>
		</ul>

	</div>

</div>