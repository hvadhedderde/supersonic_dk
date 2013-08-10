<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once("../../config/config.php");

$action = $page->access();

$IC = new Item();
$item = $IC->getCompleteItem($action[0]);
$item["tags"] = $IC->getTags($action[0]);

$page->template("admin.header.php");

?>

	<script type="text/javascript">
		function toTitleCase(str) {
		    return str.replace(/[0-9a-zA-Z]+/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
		}

		function cleanup_textarea() {
			var textarea = document.querySelector("textarea");
			textarea.value = toTitleCase(textarea.value);

			textarea.value = textarea.value.replace(/<Br>/g, "");
			textarea.value = textarea.value.replace(/H3/g, "dd");
			textarea.value = textarea.value.replace(/Label/g, "dt");
			textarea.value = "<dl>" + textarea.value + "</dl>";

		}

		function cleanup_name() {
			var textarea = document.querySelector("input[name=name]");
			textarea.value = toTitleCase(textarea.value);

		}
	</script>

<h1>Audio Edit</h1>
<form action="/cms/update/<?= $action[0] ?>" method="post" enctype="multipart/form-data">

	<div class="field">
		<label>Published at</label>
		<input type="text" name="published_at" value="<?= $item["published_at"]?>" />
	</div>

	<div class="field">
		<label onclick="cleanup_name()">Name</label>
		<input type="text" name="name" value="<?= $item["name"]?>" />
	</div>

	<div class="field">
		<label onclick="cleanup_textarea()">Description</label>
		<textarea name="description" rows="10"><?= $item["description"]?></textarea>
	</div>

	<div class="field">
		<label>File</label>
		<input type="file" name="files[]" multiple="multiple" />
	</div>


	<ul class="actions">
		<li><input type="submit" value="update" /></li>
	</ul>

</form>

<h1>Tags</h1>
<ul>
<?php if($item["tags"]) {
	foreach($item["tags"] as $index => $tag) { ?>
		<li><?= $tag["context"].":".$tag["value"] ?> - <a href="/cms/tags/delete/<?= $action[0] ?>/<?= $tag["id"] ?>">delete</a></li>
	<? }
} ?>
</ul>

<form action="/cms/tags/add/<?= $action[0] ?>" method="post">

	<div class="field">
		<label>Add Tag</label>
		<input type="text" name="tag" value="" />
	</div>

	<ul class="actions">
		<li><input type="submit" value="Add" /></li>
	</ul>

</form>

<? $page->template("admin.footer.php") ?>