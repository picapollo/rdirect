<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *	여행하기
 */
class Trips extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		echo "Trips -> ";
	}
	
	public function index(){
		$this->current();
	}

	public function current()
	{
		echo "current";
	}

	public function upcoming()
	{
		echo "upcoming";
	}

	public function previous()
	{
		echo "previous";
	}

}

/* End of file trips.php */
