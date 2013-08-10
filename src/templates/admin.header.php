<!DOCTYPE html>
<html lang="<?= $this->language() ?>">
<head>
	<!-- (c) & (p) think.dk 2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title><?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="language" content="<?= $this->language() ?>" />
	<meta name="keywords" content="" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="width=1024" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<meta http-equiv="imagetoolbar" content="no" />
<? if(Session::value("dev")) { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/admin/lib/seg_<?= $this->segment() ?>_include.css" />
	<script type="text/javascript" src="/js/admin/lib/seg_<?= $this->segment() ?>_include.js"></script>
<? } else { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/admin/seg_<?= $this->segment() ?>.css" />
	<script type="text/javascript" src="/js/admin/seg_<?= $this->segment() ?>.js"></script>
<? } ?>

</head>

<body<?= HTML::attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">
	<div id="header">
		<ul class="servicenavigation">
			<li class="keynav front"><a href="/temp">Frontpage</a></li>
		</ul>
	</div>

	<div id="content">
