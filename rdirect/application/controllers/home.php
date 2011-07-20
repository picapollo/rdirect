<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->library('tank_auth');
		$this -> load -> model('user_model');
	}

	public function index()
	{

	}

	/*
	 * 대쉬보드
	 */
	public function dashboard(){
		if( ! $this->tank_auth->is_logged_in() )
		{
			$this->session->set_flashdata('message', 'Please Login.');
			redirect('/');
		}
		$user_id = $this->tank_auth->get_user_id();
		$data['header'] = array(
			'title' 		=> 'RDirect',
			'lang' 			=> 'ko'
		);
		$user_arr = $this->user_model->get_user($user_id);
		$data['user'] = $user_arr[0];
		$this->load->view('home/dashboard', $data);
	}
	
	/**
	 * 메시지수신함
	 */
	public function indox(){
		
	}
	
	
}

/* End of file home.php */
