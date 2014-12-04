<?php
global $IC;

$text_items = $IC->getItems(array("itemtype" => "text", "status" => 1, "tags" => "page:Tour"));
?>
<div class="scene i:tour">

<?		if($text_items) { ?>
		<div class="text articlebody">
		<?	$random = rand(0, count($text_items)-1);
			$text = $text_items[$random];
			$text = $IC->extendItem($text);

			print $text["html"]; ?>

			<ul class="actions">
				<li><a href="#cphtour">CPH</a></li>
				<li><a href="#svendborgtour">Svendborg</a></li>
				<!--li><a href="#aarhustour">Aarhus</a></li-->
			</ul>
		</div>
		<? } 
	?>

	<div class="tour">

		<ul id="cphtour">
			<li style="background-image: url(/img/tour/cph/01.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/02.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/03.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/04.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/05.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/06.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/07.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/08.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/09.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/10.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/11.jpg);"></li>
			<li style="background-image: url(/img/tour/cph/12.jpg);"></li>
		</ul>

		<ul id="svendborgtour">
			<li style="background-image: url(/img/tour/svendborg/01.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/02.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/03.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/04.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/05.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/06.jpg);"></li>
			<li style="background-image: url(/img/tour/svendborg/07.jpg);"></li>
		</ul>

		<!--ul id="aarhustour">
			<li style="background-image: url(/img/tour/aarhus/01.jpg);"></li>
			<li style="background-image: url(/img/tour/aarhus/02.jpg);"></li>
			<li style="background-image: url(/img/tour/aarhus/03.jpg);"></li>
		</ul-->

	</div>

	<ul class="actions">
		<li class="back"><a href="/about">Back</a></li>
	</ul>
</div>