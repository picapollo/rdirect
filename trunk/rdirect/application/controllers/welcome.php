<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		/*if ( ! $this->tank_auth->is_logged_in()) {
			//redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['tmp']		= $this->facebook->getUser();
			$this->load->view('welcome', $data);
		}*/
		
		$data = array(
			'title' 		=> 'RDirect',
			'description' 	=> 'Description',
			'facebook_id' 	=> $this->config->item('facebook_app_id'),
			'lang' 			=> 'ko'
		);
		
		$this->load->view('header/page1', $data);
		$this->load->view('top_menu');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */