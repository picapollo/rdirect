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
			/*$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['tmp']		= $this->facebook->getUser();*/
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
		$data = array(
			'feedback_type' => 'upload_feedback',
			'callback_function' => 'upload_complete'
		);

		if( ! $user_id = $this->tank_auth->get_user_id())	// 로그인하지 않은 경우
		{
			$data['message_type'] = 'bad small';
			$data['message_content'] = 'You are not logged in.';
		}
		else
		{
			$config['upload_path'] = UPLOADS_ROOT.'/users/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name'] = 'tmp';	
			
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$data['message_type'] = 'bad small';
				$data['message_content'] = $this->upload->display_errors('','');
			}
			else
			{
				$result = $this->upload->data();
				$data['message_type'] = 'good small';
				//$data['message_content'] = $result['client_name'];
				
				$this->load->model('pictures_model');
				if( ! $this->pictures_model->create_user_images($user_id, $result['full_path']))
				{
					$data['message_content'] = 'Resize failed';
				}		
				else
				{
					$data['message_content'] = 'Successfully changed!';
					$data['username'] = $this->tank_auth->get_username();
					$data['user_profile_image'] = base_url() . 'uploads/users/' . $user_id . '/square_255.jpg?' . time();
				}	
				
				unlink($result['full_path']);
			}
		}		
		
		$this->load->view('ajax_response', $data);
	}
}

/* End of file users.php */
