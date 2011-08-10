<?php

class MY_Input extends CI_Input{
	function __construct(){
		parent::__construct();
	}
	
	function get_safe($arg = null){
		$res = array();
		if(empty($arg)){
			foreach($_GET as $k => $i){
				if($i != mysql_real_escape_string($i))
				{
					unset($_GET[$k]);
				}
				else
				{
					$res[$k] = $i;
				}
			}
			return $res;
		}
		return null;
	}
}
