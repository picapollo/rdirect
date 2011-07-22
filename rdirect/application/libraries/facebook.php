<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'facebook/facebook_lib.php';

class facebook extends Facebook_lib
{
	function __construct(){
		$CI =& get_instance();
		parent::__construct(array(
			'appId' => $CI->config->item('facebook_app_id'),
			'secret' => $CI->config->item('facebook_app_secret')
		)); 
	}
}

?>