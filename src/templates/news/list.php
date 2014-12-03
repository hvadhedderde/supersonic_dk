<?php
global $action;
global $IC;
global $itemtype;

$items = $IC->getItems(array("itemtype" => $itemtype, "status" => 1, "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene i:newslist">
	<div class="news">
		<ul class="news">
<?			foreach($items as $item): ?>
			<li class="item" itemscope itemtype="http://schema.org/BlogPosting">
				<dl class="info">
					<dt class="published_at">Date published</dt>
					<dd class="published_at" itemprop="datePublished" content="<?= date("Y-m-d", strtotime($item["published_at"])) ?>"><?= date("Y - F d.", strtotime($item["published_at"])) ?></dd>
					<dt class="hardlink">Hardlink</dt>
					<dd class="hardlink" itemprop="url"><a href="/news/<?= $item["sindex"] ?>"><?= SITE_URL."/news/".$item["sindex"] ?></a></dd>
				</dl>
				<h2 itemprop="name"><?= $item["name"] ?></h2>
				<img src="/images/<?= $item["id"] ?>/main/200x.<?= $item["mediae"]["main"]["format"] ?>" alt="<?= $item["name"] ?>" />
			</li>
<? 			endforeach; ?>
		</ul>
	</div>
</div>