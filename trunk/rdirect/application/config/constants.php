<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

$base_url	= "http://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

define('IMG_DIR', $base_url.'images');
define('CSS_DIR', $base_url.'include/css');
define('JS_DIR', $base_url.'include/js');
define('INCLUDE_DIR', $base_url.'include');
define('APP_DIR', $base_url.'application');
define('VIEW_DIR', $base_url.'application/views');
define('UPLOADS_DIR', $base_url.'uploads');
define('HOST_DIR', $_SERVER['HTTP_HOST']);
define('BASEURL', $base_url);

define('BASE_PATH', '/rdirect');
define('INCLUDE_PATH', BASE_PATH.'/include');
define('JS_PATH', INCLUDE_PATH.'/js');
define('CSS_PATH', INCLUDE_PATH.'/css');

// 추후 수정
define('DOC_ROOT', dirname(FCPATH).'/rdirect');
//define('DATA_ROOT', dirname(FCPATH).'/data');
define('INCLUDE_ROOT', DOC_ROOT.'/include');
define('JS_ROOT', DOC_ROOT.'/include/js');
define('CSS_ROOT', DOC_ROOT.'/include/css');
define('VIEW_ROOT', DOC_ROOT.'/'.APPPATH.'/views');
define('UPLOADS_ROOT', DOC_ROOT.'/uploads');


/* End of file constants.php */
/* Location: ./application/config/constants.php */