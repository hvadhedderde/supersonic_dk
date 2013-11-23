<?php
	include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");
	$query = new Query();
	$IC = new Item();

	print '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://supersonic.dk/</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/www/index.php")) ?></lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.2</priority>
	</url>
<?


	// NEWS ITEMS
	$items = $IC->getItems(array("itemtype" => "news", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/news/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/news/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach; 



	// FEATURE FILM ITEMS
	$items = $IC->getItems(array("tags" => "category:Feature films", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/feature-films</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/video/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;



	// STATIC MUSIC PAGE 
?>
	<url>
		<loc>http://supersonic.dk/music/</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/www/index.php")) ?></lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.2</priority>
	</url>
<?



	// MUSIC EXAMPLE ITEMS
	$items = $IC->getItems(array("tags" => "category:Music", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/music/examples/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/video/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;



	// MUSIC AVAILABLE ITEMS
	$items = $IC->getItems(array("tags" => "category:Tunes,category:Jingles", "limit" => 1, "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/music/available/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
<?



	// TV & DOCS ITEMS
	$items = $IC->getItems(array("tags" => "category:Tv & docs", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/tv-and-documentary</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/video/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;



	// COMMERCIAL ITEMS
	$items = $IC->getItems(array("tags" => "category:Commercial", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/commercials/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/video/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;



	// RADIO ITEMS
	$items = $IC->getItems(array("tags" => "category:Radio", "limit" => 1, "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/radio/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<?



	// VOICE CASTING - DYNAMIC TEXT
	$items = $IC->getItems(array("tags" => "page:Voice casting", "limit" => 1, "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/voice-casting/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
<?



	// ABOUT - DYNAMIC TEXT
	$items = $IC->getItems(array("tags" => "page:About", "limit" => 1, "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/about/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>
<?



	// PERSON ITEMS
	$items = $IC->getItems(array("itemtype" => "person", "status" => 1)); ?>
	<url>
		<loc>http://supersonic.dk/people/</loc>
		<lastmod><?= $items[0]["modified_at"] ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://supersonic.dk/people/<?= $item["sindex"] ?></loc>
		<lastmod><?= $item["modified_at"] ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach; 



	// TOUR - STATIC PAGE
?>
	<url>
		<loc>http://supersonic.dk/tour</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/tour/list.php")) ?></lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
</urlset>