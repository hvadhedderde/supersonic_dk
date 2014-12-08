	</div>

	<div id="navigation">
		<ul>
			<?= $HTML->link("News", "/janitor/admin/news/list", array("wrapper" => "li.news")) ?>
			<?= $HTML->link("Audio", "/janitor/admin/audio/list", array("wrapper" => "li.audio")) ?>
			<?= $HTML->link("Video", "/janitor/admin/video/list", array("wrapper" => "li.video")) ?>
			<?= $HTML->link("Page texts", "/janitor/admin/text/list", array("wrapper" => "li.text")) ?>
			<?= $HTML->link("People", "/janitor/admin/person/list", array("wrapper" => "li.person")) ?>

			<?= $HTML->link("Tags", "/janitor/admin/tag/list", array("wrapper" => "li.tags")) ?>
			<?= $HTML->link("Users", "/janitor/admin/user/list", array("wrapper" => "li.user")) ?>
		</ul>
	</div>

	<div id="footer">
		<ul class="servicenavigation">
			<li class="copyright">Janitor, Manipulator, Modulator - parentNode - Copyright 2014</li>
		</ul>
	</div>

</div>

</body>
</html>