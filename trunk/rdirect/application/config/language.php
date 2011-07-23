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
    'en'=> array('name' => 'English', 'folder' => 'english'),
    'ko'=> array('name' => '한국어', 'folder' => 'korean'),
    'ja'=> array('name' => '日本語', 'folder' => 'japanese'),
    'zh'=> array('name' => '中文(简体)', 'folder' => 'chinese')
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