	</div>

<?php

function menuItem($title, $url) {
	global $page;

	$selected = false;
	$related_urls = func_get_args();
	array_shift($related_urls);
	foreach($related_urls as $value) {
		if(preg_match("/^".preg_replace("/\//", "\/", $value)."/", $page->url)) {
			$selected = true;
		}
	}
	return '<li'.$HTML->attribute("class", ($selected ? "selected" : "")).'><a href="' . $url . '">' . $title . '</a></li>';
}
?>
	<div id="navigation">
		<ul>
			<?= menuItem("News", "/news") ?>
			<?= menuItem("Feature Films", "/feature-films") ?>
			<?= menuItem("Music", "/music") ?>
			<?= menuItem("TV & Docs", "/tv-and-documentary") ?>
			<?= menuItem("Commercials", "/commercials") ?>
			<?= menuItem("Radio", "/radio") ?>
			<?= menuItem("Voice Casting", "/voice-casting") ?>
			<?= menuItem("Visuals", "/visuals") ?>
			<?= menuItem("About", "/about", "/people", "/tour") ?>
		</ul>
	</div>

	<div id="footer">
		<div class="vcard company cph" itemscope itemtype="http://schema.org/Organization">
			<div class="name fn org" itemprop="name">Supersonic CPH</div>
			<div class="adr" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<div class="street-address" itemprop="streetAddress">Lille Strandstræde 20C</div>
				<div class="city"><span class="postal-code" itemprop="postalCode">1254</span> <span class="locality" itemprop="addressLocality">Copenhagen K</span></div>
				<div class="country-name" itemprop="addressCountry">Denmark</div>
				<div class="geo" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">&phi; <span class="latitude" itemprop="latitude">55,680896</span>°; &lambda; <span class="longitude" itemprop="longitude">12,57363</span>°</div>
			</div>
			<div class="tel" itemprop="telephone"><a href="callto:+4533116030">+45 33 11 60 30</a></div>
		</div>
		<div class="vcard company svendborg" itemscope itemtype="http://schema.org/Organization">
			<div class="name fn org" itemprop="name">Supersonic SVENDBORG</div>
			<div class="adr" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<div class="street-address" itemprop="streetAddress">Abildvej 5 E</div>
				<div class="city"><span class="postal-code" itemprop="postalCode">5700</span> <span class="locality" itemprop="addressLocality">Svendborg</span></div>
				<div class="country-name" itemprop="addressCountry">Denmark</div>
				<div class="geo" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">&phi; <span class="latitude" itemprop="latitude">55,060696</span>°; &lambda; <span class="longitude" itemprop="longitude">10,62494</span>°</div>
			</div>
			<div class="tel" itemprop="telephone"><a href="callto:+4533116030">+45 33 11 60 30</a></div>
		</div>
	</div>

</div>

</body>
</html>