<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>People</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<form action="/cms/save/person" method="post" enctype="multipart/form-data">

	<div class="field">
		<label>Name</label>
		<input type="text" name="name" />
	</div>

	<div class="field">
		<label>Nickname</label>
		<input type="text" name="nickname" />
	</div>

	<div class="field">
		<label>Title</label>
		<input type="text" name="title" />
	</div>

	<div class="field">
		<label>Email</label>
		<input type="text" name="email" />
	</div>

	<div class="field">
		<label>Description</label>
		<textarea name="description"></textarea>
	</div>

	<div class="field">
		<label>Image</label>
		<input type="file" name="files[]" />
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

</form>

<? $page->template("admin.footer.php") ?>