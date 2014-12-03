<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:People"));

$items_booking = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Booking"));
$items_audio = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Audio"));
$items_mix = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Mix & mastering"));
$items_service = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Service"));
$items_visuals = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Visuals"));
$items_admin = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Administration"));
$items_freelance = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Freelance"));
?>
<div class="scene i:people">

<?		if($text_items) { ?>
		<div class="text">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>

			<div class="columns">

				<div class="column">

					<div class="group">
						<h2>Booking</h2>
						<ul class="people">
				<?php
					foreach($items_booking as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Audio</h2>
						<ul class="people">
				<?php
					foreach($items_audio as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Mix &amp; mastering</h2>
						<ul class="people">
				<?php
					foreach($items_mix as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

				</div>

				<div class="column">

					<div class="group">
						<h2>Service</h2>
						<ul class="people">
				<?php
					foreach($items_service as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Visuals</h2>
						<ul class="people">
				<?php
					foreach($items_visuals as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Administration</h2>
						<ul class="people">
				<?php
					foreach($items_admin as $item) {
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Freelance</h2>
						<ul class="people">
				<?php
					foreach($items_freelance as $item):
						$item = $IC->extendItem($item); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? endforeach; ?>
						</ul>
					</div>

				</div>
			</div>

		</div>
		<? } 
	?>

	<div class="people">

		<div class="person"></div>

	</div>

	<ul class="actions">
		<li class="back"><a href="/about">Back</a></li>
	</ul>
</div>