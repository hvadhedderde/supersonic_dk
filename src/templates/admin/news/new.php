<?php

$action = $this->actions();

$IC = new Item();
$model = $IC->typeObject("news");

?>
<div class="scene defaultNew">
	<h1>New news</h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/news/list" class="button">Back</a></li>
	</ul>

	<form action="/admin/cms/save/news" class="i:formDefaultNew labelstyle:inject" method="post" enctype="multipart/form-data">

		<fieldset>
			<?= $model->input("published_at") ?>
			<?= $model->input("name") ?>
			<?= $model->input("text", array("class" => "autoexpand")) ?>
		</fieldset>

		<ul class="actions">
			<li class="cancel"><a href="/admin/news/list" class="button">Back</a></li>
			<li class="save"><input type="submit" value="Save" class="button primary" /></li>
		</ul>

	</form>

</div>



<!--form action="/cms/save/news" method="post" enctype="multipart/form-data">

	<div class="field">
		<label>Published at</label>
		<input type="text" name="published_at" />
	</div>

	<div class="field">
		<label>Name</label>
		<input type="text" name="name" />
	</div>

	<div class="field">
		<label>Text</label>
		<textarea name="text"></textarea>
	</div>

	<div class="field">
		<label>Image</label>
		<input type="file" name="files[]" multiple="multiple" />
	</div>

	<div class="field">
		<label>Tag 1</label>
		<input type="text" name="tags[0]" />
	</div>

	<div class="field">
		<label>Tag 2</label>
		<input type="text" name="tags[1]" />
	</div>

	<div class="field">
		<label>Tag 3</label>
		<input type="text" name="tags[2]" />
	</div>

	<ul class="actions">
		<li><input type="submit" value="save" /></li>
	</ul>

</form-->
