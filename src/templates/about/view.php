<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:About"));
?>
<div class="scene">

<?		if($text_items) { ?>
		<div class="text">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["text"]; ?>

			<div class="contact">
				<h2>Contact</h2>

				<dl class="booking">
					<dt>Phone</dt>
					<dd><a href="callto:+4533116030">+45 33 11 60 30</a></dd>

					<dt>Booking</dt>
					<dd><a href="mailto:booking@supersonic.dk">booking@supersonic.dk</a></dd>
				</dl>

				<div class="charity">
					<p>Supersonic is a supporter of SOS, RedCross, The Danish Cancer Society, Save the Children, and Landsindsamlingen Denmark.</p>
				</div>
			</div>

		</div>
		<? } 
	?>

	<div class="about">

		<ul class="subnavigation">
			<li>
				<h2>People</h2>
				<p>The talented and fabulous crowd of Supersonic.</p>
				<ul class="actions">
					<li><a href="/people">Snoop around</a></li>
				</ul>
			</li>
			<li>
				<h2>Tour</h2>
				<p>We snapped some photos of our studios.</p>
				<ul class="actions">
					<li><a href="/tour">Peek inside</a></li>
				</ul>
			</li>
		</ul>

	</div>


</div>