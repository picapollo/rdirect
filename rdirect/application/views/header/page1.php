<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$title?></title>

        <meta name="title" content="<?=$title?>">
        <meta name="description" content="<?=$description?>">

    <link rel="image_src" href="<?=IMG_DIR?>/airbnb_logo.png">
    <!--<link rel="search" type="application/opensearchdescription+xml" href="http://www.airbnb.com/opensearch.xml" title="Airbnb"> -->
    <!--[if (!IE)|(gte IE 8)]><!-->
<link href="<?=CSS_DIR?>/common-datauri.css" media="screen" rel="stylesheet" type="text/css">
<!--<![endif]-->
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/common.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]-->
    <!--[if (!IE)|(gte IE 8)]><!-->
<link href="<?=CSS_DIR?>/page1-datauri.css" media="screen" rel="stylesheet" type="text/css">
<!--<![endif]-->
<!--[if lte IE 7]>
<link href="<?=CSS_DIR?>/page1.css" media="screen" rel="stylesheet" type="text/css" />
<![endif]-->

		<link href="<?=CSS_DIR?>/korean_fonts.css" media="screen" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
		
		<script type="text/javascript">var base_url = "<?=base_url()?>";</script>
		
		<?php if($locale != 'en'): ?>
		<script src="<?=JS_DIR?>/jquery.ui.datepicker/jquery.ui.datepicker-<?=$locale?>.min.js" type="text/javascript"></script>
		<?php endif; ?>

		<script src="<?=JS_DIR?>/common.js" type="text/javascript"></script>
		<script src="<?=JS_DIR?>/page1.js" type="text/javascript"></script>

		<link rel="shortcut icon" href="<?=IMG_DIR?>/airbnb_favicon.ico" /> 
	<script src="<?=JS_DIR?>/jquery.autocomplete_custom.pack.js" class="lazyload" charset="utf-8"></script><script src="<?=JS_DIR?>/<?=$locale?>_autocomplete_data.js" class="lazyload" charset="utf-8"></script>
</head>
<body>