<!DOCTYPE html>
<html lang="<?= $this->language() ?>">
<head>
	<!-- (c) & (p) hvadhedderde.dk 2011, 2012, 2013, 2014 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<!-- Released on CPAL-License https://github.com/kaestel/supersonic_dk/blob/master/LICENSE-CPAL.md //-->
	<title><?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="initial-scale=1" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<meta http-equiv="imagetoolbar" content="no" />
<? if(session()->value("dev")) { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/lib/seg_<?= $this->segment() ?>_include.css" />
	<script type="text/javascript" src="/js/lib/seg_<?= $this->segment() ?>_include.js"></script>
<? } else { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= $this->segment() ?>.css" />
	<script type="text/javascript" src="/js/seg_<?= $this->segment() ?>.js"></script>
<? } ?>
</head>

<body<?= $HTML->attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">
	<div id="header">
		<ul class="servicenavigation">
			<li class="keynav front"><a href="/">Frontpage</a></li>
			<li class="keynav navigation nofollow"><a href="#navigation" rel="nofollow">Navigation</a></li>
		</ul>
	</div>

	<div id="content">
