<?php 	if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		echo "users";
	}

}

/* End of file users.php */