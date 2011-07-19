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
		if ( ! $this->tank_auth->is_logged_in()) {
			//redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['tmp']		= $this->facebook->getUser();
			$this->load->view('welcome', $data);
		}
	}

	public function index()
	{
		echo "users";
	}
	
	public function login(){
		if($this->tank_auth->is_logged_in())
			//TODO: Redirect to dashboard
			;
			
		$data = array(
			'title' 		=> 'RDirect',
			//'description' 	=> 'Description',
			'facebook_id' 	=> $this->config->item('facebook_app_id'),
			'lang' 			=> 'ko',
			//'user_id'		=> $this->tank_auth->get_user_id()
		);
		
		$this->load->view('header/signup_login', $data);
		$this->load->view('top_menu');
		$this->load->view('login');
	}

	public function signup_login(){
		if($this->tank_auth->is_logged_in())
			//TODO: Redirect do dashboard
		$this->load->view('signup_login');
		echo "signup_login";
	}
	
	public function ajax_image_upload(){
		echo 'ajax_image_upload';
	}
}

/* End of file users.php */
