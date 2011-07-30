<?php

class Search extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->view('search', $this->data);
	}
	
	function ajax_get_results(){
		$opt = array();
		foreach($_GET as $k=>$i){
			$opt[$k] = $this->input->get($k);
		}
		
		$this->load->view('ajax/search_results', $this->data);
	}
}

?>