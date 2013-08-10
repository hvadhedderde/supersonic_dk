<div class="scene i:people">

	<?php
		$IC = new Item();
		$items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:People"));

		if($items) { ?>
		<div class="text">
		<?	$random = rand(0, count($items)-1);
			$item = $items[$random];
			$item = $IC->getCompleteItem($item["id"]);

			print $item["text"]; ?>


			<div class="columns">

				<div class="column">

					<div class="group">
						<h2>Booking</h2>
						<ul class="people">
				<?php
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Booking"));

					foreach($items as $item) {
						$item = $IC->getCompleteItem($item["id"]); ?>
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
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Audio"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
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
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Mix & mastering"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
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
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Service"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
						</ul>
					</div>

					<div class="group">
						<h2>Editor</h2>
						<ul class="people">
				<?php
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Editor"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
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
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Administration"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
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
					$IC = new Item();
					$items = $IC->getItems(array("itemtype" => "person", "status" => 1, "tags" => "department:Freelance"));

					foreach($items as $item) {

						$item = $IC->getCompleteItem($item["id"]); ?>
							<li>
								<a href="/people/<?= $item["sindex"] ?>"><?= $item["nickname"] ?></a>
							</li>
				<? 
					}
				?>
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
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>
</div>