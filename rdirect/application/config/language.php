<?php

/*
|--------------------------------------------------------------------------
| Supported Languages
|--------------------------------------------------------------------------
|
| Contains all languages your site will store data in. Other languages can
| still be displayed via language files, thats totally different.
| 
| Check for HTML equivalents for characters such as � with the URL below:
|    http://htmlhelp.com/reference/html40/entities/latin1.html
|
*/
$config['supported_languages'] = array(
    'en'=> array('name' => 'English', 'folder' => 'english', 'currency'=>'USD', 'lang_code'=>'en_US'),
    'ko'=> array('name' => '한국어', 'folder' => 'korean', 'currency'=>'KRW', 'lang_code'=>'ko_KR'),
    'ja'=> array('name' => '日本語', 'folder' => 'japanese', 'currency'=>'JPY', 'lang_code'=>'ja_JP'),
    'zh'=> array('name' => '中文(简体)', 'folder' => 'chinese', 'currency'=>'CNY', 'lang_code'=>'zh_CN')
);

$config['supported_currency'] = array(
	'USD'=> array('name'=>'United Status Dollars', 'symbol'=>'$'),
	'KRW'=> array('name'=>'원', 'symbol'=>"₩"),
	'JPY'=> array('name'=>'円', 'symbol'=>'¥'),
	'CNY'=> array('name'=>'元', 'symbol'=>'¥')
);

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| If no language is specified, which one to use? Must be in the array above
|
|   en
|
*/
$config['default_language'] = 'en';

?>