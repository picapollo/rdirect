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
		$this->config->set_item('language', 'english');
	}

	public function index()
	{
		$this->load->library('geocoder');
		print_r($this->geocoder->geocode_by_latlng('37.57268,126.9336'));
	}

	public function ajax()
	{
		echo $this->input->post('new_locale');
	}
}

/* End of file test.php */
