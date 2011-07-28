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
	
	function get_facebook_cookie() 
	{
		// get the fb app id, and secret from CI config source
		$CI =& get_instance();
		$app_id = $CI->config->item('facebook_app_id');
		$application_secret = $CI->config->item('facebook_app_secret');
		if(isset($_COOKIE['fbs_' . $app_id])){
  			$args = array();
  			parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  			ksort($args);
  			$payload = '';
  			foreach ($args as $key => $value) {
    				if ($key != 'sig') {
      				$payload .= $key . '=' . $value;
    				}
  			}
  			if (md5($payload . $application_secret) != $args['sig']) {
    				return null;
  			}
  			return $args;
  		}
  		else{
			return null;
  		}
	}
}

?>