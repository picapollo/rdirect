<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Hosting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}
	
	public function index(){
		
	}
	
	/**
	 * 객실정보관리
	 */
	public function rooms(){
		echo "hosting: rooms";
	}
		
	/**
	 * 예약관리
	 */
	public function my_listings(){
		
	}
}

/* End of file hosting.php */
