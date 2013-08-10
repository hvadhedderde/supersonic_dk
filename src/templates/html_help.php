<div class="<?= $this->getResponseColumn() ?>">
	<?= $this->designHeader() ?>
	<fieldset>
	<div class="c300">
		<h1>HTML Guidelines</h1>
		<p>When layouting text using HTML, these elements can be used.</p>
		<p>
			<strong>&lt;h1&gt;Header 1&lt;/h1&gt;</strong><br />
			Heading 01, Auto-linebreak, White, 10px padding-bottom
			<br /><br />
			<strong>&lt;h2&gt;Header 2&lt;/h2&gt;</strong><br />
			Heading 02, Auto-linebreak, White, 2px padding-bottom
			<br /><br />
			<strong>&lt;p&gt;Paragraf&lt;/p&gt;</strong><br />
			Paragraph, Auto-linebreak, White on frontpages and news, grey elsewhere, 2px padding-bottom
			<br /><br />
			<strong>&lt;br&gt;</strong><br />
			Linebreak
			<br /><br />
			<strong>&lt;label&gt;Label:&lt;/label&gt;</strong><br />
			Label, Grey, 2px padding-bottom
			<br /><br />
			<strong>&lt;h3&gt;Value&lt;/h3&gt;</strong><br />
			Heading 03/Label value, White, 2px padding-bottom
			<br /><br />
			<strong>&lt;em&gt;Italic&lt;/em&gt;</strong><br />
			Italic text
			<br /><br />
			<strong>&lt;strong&gt;Bold&lt;/strong&gt;</strong><br />
			Bold text
			<br /><br />
			<strong>&lt;a href=""&gt;Link&lt;/a&gt;</strong><br />
			Link
			<br /><br />
		</p>
	</div>
	<div class="c300">
		<h2>Examples</h2>
		<div class="c150">
			<p>
				&lt;h2&gt;ROYKSOPP&lt;/h2&gt;<br />
				&lt;h2&gt;WHAT ELSE IS THERE&lt;/h2&gt;<br />
				&lt;br&gt;<br />
				&lt;label&gt;DIRECTOR:&lt;/label&gt;&lt;h3&gt;MARTIN DE THURAH&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;PRODUCTION:&lt;/label&gt;&lt;h3&gt;ACADEMY FILMS LTD&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;DOP:&lt;/label&gt;&lt;h3&gt;CASPER TUXEN&lt;/h3&gt;&lt;br&gt;&lt;br&gt;<br />
				&lt;h2&gt;CREDITS:&lt;/h2&gt;<br />
				&lt;label&gt;EDITING:&lt;/label&gt;&lt;h3&gt;DUCKLING&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;MUSIC:&lt;/label&gt;&lt;h3&gt;SUPERSONIC&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;SOUND:&lt;/label&gt;&lt;h3&gt;SUPERSONIC&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;GRADING:&lt;/label&gt;&lt;h3&gt;DUCKLING&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;CGI:&lt;/label&gt;&lt;h3&gt;DUCKLING&lt;/h3&gt;&lt;br&gt;<br />
				&lt;label&gt;FLAME:&lt;/label&gt;&lt;h3&gt;DUCKLING&lt;/h3&gt;&lt;br&gt;
			</p>
		</div>
		<div class="c150">
			<p>
				<div class="htmlView">
					<h2>ROYKSOPP</h2>
					<h2>WHAT ELSE IS THERE</h2>
					<br>
					<label>DIRECTOR:</label><h3>MARTIN DE THURAH</h3><br>
					<label>PRODUCTION:</label><h3>ACADEMY FILMS LTD</h3><br>
					<label>DOP:</label><h3>CASPER TUXEN</h3><br><br>
					<h2>CREDITS:</h2>
					<label>EDITING:</label><h3>DUCKLING</h3><br>
					<label>MUSIC:</label><h3>SUPERSONIC</h3><br>
					<label>SOUND:</label><h3>SUPERSONIC</h3><br>
					<label>GRADING:</label><h3>DUCKLING</h3><br>
					<label>CGI:</label><h3>DUCKLING</h3><br>
					<label>FLAME:</label><h3>DUCKLING</h3><br>
				</div>
			</p>
		</div>
	</div>
	</fieldset>
	<?= $this->designFooter() ?>
</div>
