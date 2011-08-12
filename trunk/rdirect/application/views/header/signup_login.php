<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<title><?=$title?></title>
		<meta name="title" content="<?=$title?>" />
		<link rel="image_src" href="<?=IMG_DIR?>/airbnb_logo.png" />
		<link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="Airbnb" />
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link media="screen" rel="stylesheet" type="text/css" href="<?=CSS_DIR?>/common-datauri.css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<?php if(CURRENT_LANGUAGE == 'ko'): ?>
		<link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" />
		<?php endif; ?>
		<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> -->
		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script>
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link href="<?=CSS_DIR?>/signinup-datauri.css" media="screen" rel="stylesheet" type="text/css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/signinup.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<!--[if IE]>
		<link href="<?=CSS_DIR?>/signinup_ie.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<script src="<?=JS_DIR?>/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?=JS_DIR?>/signinup.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="/favicon.ico" />
	</head>