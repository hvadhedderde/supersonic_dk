<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Music"));
?>
<div class="scene">

<?		if($text_items) { ?>
		<div class="text">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>
		</div>
<? 		} ?>

	<div class="music">

		<ul class="subnavigation">
			<li>
				<h2>Examples</h2>
				<p>Watch some of the work we have done with original music and sound design created by Supersonic CPH.</p>
				<ul class="actions">
					<li><a href="/music/examples">Watch</a></li>
				</ul>
			</li>
			<li>
				<h2>Available Music</h2>
				<p>Find the right tune for your next project or get inspired in our list of available music composed by Supersonic CPH.</p>
				<ul class="actions">
					<li><a href="/music/available">Listen</a></li>
				</ul>
			</li>
		</ul>

	</div>
</div>