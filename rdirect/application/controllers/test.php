<?php 	if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Test extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		echo '<pre>';
	}

	public function index()
	{
		$this->load->view('v_test', array('hi'=>'he'));
	}
	
	/*
	 *	영어 주소명 저장 위한 역 지오코딩 예제
	 */
	function geocode($address = '서울특별시 서대문구 연희동 112-3')
	{
		$this->load->library('geocoder');
		//$address = mysql_escape_string($address);
		$address = urlencode($address);
		//print_r($this->geocoder->geocode_by_latlng('37.57268,126.9336'));
		echo '<pre>';
		print_r($this->geocoder->geocode_by_address($address));
	}

	public function ajax()
	{
		echo $this->input->post('new_locale');
	}
}

/* End of file test.php */