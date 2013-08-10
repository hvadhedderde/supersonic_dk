<div class="scene i:posters">
	<div class="tv">

		<h1>TV &amp; Documentary</h1>
		<ul class="posters">
			<?php
				$IC = new Item();
				$items = $IC->getItems(array("status" => 1, "tags" => "category:Tv & Docs", "order" => "sindex"));
				if($items) {
					foreach($items as $item) {
						$item = $IC->getCompleteItem($item["id"]);
			
						if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/thumbnail")) {
							$image = "/images/".$item["id"]."/thumbnail/240x.jpg";
						}
						else {
							$image = "/img/missing_240x320.png";
						} ?>
						<li style="background-image: url(<?= $image ?>);">
							<a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a>
						</li>
			<?		}
				} ?>


			<li style="background-image: url(/img/poster_honey_moon.jpg);">
				<h2><a href="/video/honey_moon">Honey Moon</a></h2>
			</li>
			<li style="background-image: url(/img/poster_human_nature.jpg);">
				<h2><a href="/video/human_nature">The Human Nature</a></h2>
			</li>
			<li style="background-image: url(/img/poster_peaceforce.jpg);">
				<h2><a href="/video/peaceforce">Peaceforce</a></h2>
			</li>
			<li style="background-image: url(/img/poster_de_fantastiske_3.jpg);">
				<h2><a href="/video/de_fantastiske_3">De Fantastiske 3</a></h2>
			</li>
		</ul>

	</div>
</div>

