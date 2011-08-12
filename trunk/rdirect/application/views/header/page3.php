<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<title><?=$title?></title>
		<link rel="canonical" href="<?=current_url()?>" />
		<meta name="title" content="<?=$title?>" />
		<meta name="description" content="<?=$description?>" />
		<link rel="image_src" href="<?=IMG_DIR?>/airbnb_logo.png" />
		<link rel="search" type="application/opensearchdescription+xml" href="<?=base_url()?>opensearch.xml" title="Airbnb" />
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link href="<?=CSS_DIR?>/common-datauri.css" media="screen" rel="stylesheet" type="text/css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<!--[if (!IE)|(gte IE 8)]><!-->
		<link href="<?=CSS_DIR?>/page3-datauri.css" media="screen" rel="stylesheet" type="text/css" />
		<!--<![endif]-->
		<!--[if lte IE 7]>
		<link href="<?=CSS_DIR?>/page3.css" media="screen" rel="stylesheet" type="text/css" />
		<![endif]-->
		<?php if(CURRENT_LANGUAGE == 'ko'): ?>
		<link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css" />
		<?php endif; ?>
		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=JS_DIR?>/jquery-ui-1.8.14.custom.min.js"></script> 
		<?php if(CURRENT_LANGUAGE != 'en'): ?>
		<script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-<?=CURRENT_LANGUAGE?>.min.js" type="text/javascript"></script>
		<?php endif;?>
		<script src="<?=JS_DIR?>/page3.js" type="text/javascript"></script>
		<link rel="shortcut icon" href="/favicon.ico" />
