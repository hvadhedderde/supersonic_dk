<?php
global $action;
global $IC;
global $itemtype;

$item = $IC->getItem(array("sindex" => $action[0], "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene i:newsview">
	<div class="news" itemscope itemtype="http://schema.org/BlogPosting">

		<dl class="info">
			<dt class="published_at">Date published</dt>
			<dd class="published_at" itemprop="datePublished" content="<?= date("Y-m-d", strtotime($item["published_at"])) ?>"><?= date("Y - F d.", strtotime($item["published_at"])) ?></dd>
		</dl>

		<h2itemprop="name"><?= $item["name"] ?></h2>
		<img src="/images/<?= $item["id"] ?>/200x90.<?= $item["mediae"]["main"]["format"] ?>" alt="<?= $item["name"] ?>" />

		<div class="articlebody" itemprop="articleBody">
			<?= $item["text"] ?>
		</div>

	</div>

	<ul class="actions">
		<? if(isset($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], $_SERVER["HTTP_HOST"])) { ?>
			<li class="back"><a href="<?= $_SERVER["HTTP_REFERER"] ?>">Back</a></li>
		<? } ?>
	</ul>
</div>