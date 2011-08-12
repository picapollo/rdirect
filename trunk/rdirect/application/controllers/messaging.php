<?php

class Messaging extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		redirect('');
	}
	
	function inbox(){
		$this->_add_notice('inbox: under construction');
		redirect('');
	}
	
	function remove_special_offer($mid){
		$sig = $this->input->get('sig');
		redirect();
	}
	
	function qt_reply_v2($mid){
		
	}
	
	function question($mid){
		
	}
	
	function answer($mid){
		
	}
}

?>