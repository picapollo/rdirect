<?php 	if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		$this->load->library('facebook');
		print_r($this->facebook->get_facebook_cookie());
	}

}

/* End of file test.php */
