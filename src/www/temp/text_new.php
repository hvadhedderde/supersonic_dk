<!DOCTYPE html>
<html lang="en">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Text</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>

<form action="/cms/save/text" method="post">

	<div class="field">
		<label>Name</label>
		<input type="text" name="name" />
	</div>

	<div class="field">
		<label>Text</label>
		<textarea name="text"></textarea>
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

</body>
</html>