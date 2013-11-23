<div class="scene i:posters">
	<div class="tv">

		<h1>TV &amp; Documentary</h1>
		<ul class="posters">
		<?php
			$IC = new Item();
			$items = $IC->getItems(array("status" => 1, "tags" => "category:Tv & Docs"));
			if($items) {
				foreach($items as $item) {
					$item = $IC->getCompleteItem($item["id"]);
		
					if(file_exists(PRIVATE_FILE_PATH."/".$item["id"]."/poster/".$item["poster"])) {
						$image = "/images/".$item["id"]."/poster/240x.".$item["poster"];
					}
					else {
						$image = "/images/0/missing/240x320.png";
					}
			?>
			<li style="background-image: url(<?= $image ?>);">
				<h2><a href="/video/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h2>
			</li>
			<?
				}
			} 
		?>
		</ul>

	</div>
</div>

