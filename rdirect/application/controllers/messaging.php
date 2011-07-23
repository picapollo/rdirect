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
}

?>