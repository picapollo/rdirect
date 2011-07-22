<?php 	if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Users extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	function index()
	{
		echo "users";
	}
	
	function login(){
		if($this->tank_auth->is_logged_in())
			redirect('home/dashboard');
		
		$this->data['fb'] = FALSE;
		$this->data['signup_flag'] = FALSE;
				
		$this->load->view('signup_login', $this->data);
	}

	function signup_login(){
		if($this->tank_auth->is_logged_in())
			redirect('home/dashboard');
		
		// Facebook connect 대신 이메일 주소로 가입		
		if(($hf = $this->input->get('hf')) !== null)
		{
			$this->session->set_userdata(array('hf' => $hf));
		}
		else
		{
			$hf = $this->session->userdata('hf');
		}
			
		$this->data['fb'] = ! $hf;
		$this->data['header']['title'] = 'Sign In / Sign Up';
		$this->data['signup_flag'] = TRUE;
		
		$this->load->view('signup_login', $this->data);
	}
	
	function ajax_image_upload(){
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

	function change_locale(){
		$this->load->config('language');
		//var_dump($_POST);
		$lang = $this->input->post('new_locale');
		echo $lang;
		if(in_array($lang, array_keys($this->config->item('supported_languages'))))
		{
			if($this->tank_auth->is_logged_in()){
				$this->load->model('users_model');
				$this->users_model->set_user_locale($this->tank_auth->get_user_id(), $lang);
			}
			$this->session->set_userdata('locale', $lang);
		}
	}
}

/* End of file users.php */
