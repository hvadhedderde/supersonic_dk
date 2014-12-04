<?php
global $action;
global $IC;
global $itemtype;

$item = $IC->getItem(array("sindex" => $action[0], "extend" => array("mediae" => true)));
?>
<div class="scene">

	<div class="text"></div>

	<div class="person">

		<?php
			if($item) {
				$media = $IC->sliceMedia($item, "main");
//				$item = array_merge($item, $IC->TypeObject($item["itemtype"])->get($item["id"]));
		?>
		<div class="profile" style="background-image: url(/images/<?= $item["id"] ?>/main/232x270.<?= $media["format"] ?>);">

			<h1><?= $item["name"] ?></h1>
			<div class="role"><?= $item["title"] ?></div>
			<div class="email"><a href="mailto:<?= $item["email"] ?>"><?= $item["email"] ?></a></div>
			<div class="articlebody"><?= $item["html"] ?></div>

		</div>
			

		<? } ?>
	</div>

	<ul class="actions">
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>

</div>