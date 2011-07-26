<?php if(!defined('BASEPATH')) 	exit('No direct script access allowed');
/**
 *
 */
class Home extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->library('tank_auth');
		$this -> load -> model('users_model');
	}

	public function index()
	{
		$this->data['header']['facebook_id'] = $this->config->item('facebook_app_id');
		$this->data['header']['locale'] = CURRENT_LANGUAGE;
		
		$this->load->view('header/page1', $this->data['header']);
		$this->load->view('top_menu', $this->data['notices']);
		$this->load->view('footer');
	}

	/*
	 * 대쉬보드
	 */
	public function dashboard(){
		if( ! $this->tank_auth->is_logged_in() )
		{
			$this->_add_notice(lang('message_please_login'));
			redirect('');
		}
		$user_id = $this->tank_auth->get_user_id();
		$this->data['user'] = $this->users_model->get_user($user_id);
		$this->load->view('home/dashboard', $this->data);
	}
	
	/**
	 * 메시지수신함
	 */
	public function indox(){
		
	}
	
	function cancellation_policies(){
		echo 'cancellation_policies';
	}
}

/* End of file home.php */
