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
		redirect('');
	}
	
	function login(){
		if($this->tank_auth->is_logged_in())
			redirect('home/dashboard');
		
		$this->data['fb'] = FALSE;
		$this->data['signup_flag'] = FALSE;
		$this->data['redirect_params'] = $this->input->get('redirect_params');		
		$this->load->view('signup_login', $this->data);
	}

	function signup_login(){
		if($this->tank_auth->is_logged_in())
			redirect('home/dashboard');
		
		$this->data['redirect_params'] = $this->input->get('redirect_params');
		
		// Facebook connect 대신 이메일 주소로 가입		
		if($this->input->get('hf') || !empty($this->data['redirect_params']) )
		{
			$this->data['fb'] = FALSE;
		}
		else
		{
			$this->data['fb'] = TRUE;
		}

		$this->data['header']['title'] = 'Sign In / Sign Up';
		
		$this->data['signup_flag'] = TRUE;
		
		$this->load->view('signup_login', $this->data);
	}
	
	function show($user_id = null){
		if(!$user_id) show_404('');	
		
		$this->data['user'] = $this->users_model->get_user($user_id);
		if(!$this->data['user']) show_404('');
		
		$this->load->view('users/show', $this->data);
	}
	
	function edit_profile(){
		if( ! $this->tank_auth->is_logged_in())
			redirect('home/dashboard');
			
		$this->data['user'] = $this->users_model->get_user($this->tank_auth->get_user_id());
		$this->load->view('users/edit_profile', $this->data);
	}
	
	function update_profile($user_id)
	{
		if($this->tank_auth->get_user_id() != $user_id || $this->input->post('user_profile_info') == false){
			$this->_add_notice('Invalid access');
			echo '<script type="text/javascript">history.back()</script>';
		}
		
		$this->users_model->update_user_profile($user_id, $this->input->post('user_profile_info'));
		$this->_add_notice('<span class="good" style="font-size:18px;">Profile Updated Successfully</span><br>'.anchor('users/edit_profile', 'Edit Profile Again').' | '.anchor('dashboard', 'Go to Dashboard'));
		redirect('users/show/'.$user_id);
	}
	
	function change_locale(){
		//$this->load->config('language');	// autoload
		$lang = $this->input->post('new_locale');
		//echo $lang;
		if(in_array($lang, array_keys($this->config->item('supported_languages'))))
		{
			if($this->tank_auth->is_logged_in()){
				$this->users_model->set_user_locale($this->tank_auth->get_user_id(), $lang);
			}
			$this->session->set_userdata('locale', $lang);
		}
	}
	
	function change_currency(){
		$cur = $this->input->post('new_currency');
		if(in_array($cur, array_keys($this->config->item('supported_currency'))))
		{
			if($this->tank_auth->is_logged_in()){
				$this->users_model->set_user_currency($this->tank_auth->get_user_id(), $cur);
			}
			$this->session->set_userdata('currency', $cur);
		}
	}
	
	function populate_from_facebook()
	{
		if( ! $uid = $this->tank_auth->get_user_id() )
			$this->_history_back();
		
		$this->load->library('facebook');
		$fb_cookie = $this->facebook->get_facebook_cookie();
		if(empty($fb_cookie['access_token']))
			$this->_history_back();
		
		$this->facebook->setAccessToken($fb_cookie['access_token']);
		$fb_user = $this->facebook->api('/me');
		
		if($fb_user)
		{
			$fb_user['id'] = mysql_real_escape_string($fb_user['id']);
			$another_user = $this -> users_model -> get_user_by_sm(array('facebook_id' => $fb_user['id']), 'facebook_id');
			if(sizeof($another_user) != 0 && $another_user[0]->id != $uid) 
			{
				$this->_add_notice('Another account with the same facebook account exists.');
				$this->_history_back();
			}
			else
			{
				$user = $this->users_model->get_user($uid);
				
				$update_data = array('facebook_id' => $fb_user['id']);

				if($user->university == '')
				{				
					$university = array();
					foreach($fb_user['education'] as $i)
					{
						$university[] = $i['school']['name'];
					}
					
					$update_data['university'] = implode(', ', $university); 
				}

				if(! $user->has_photo)
				{
					$this->load->model('pictures_model');
					if($this->pictures_model->create_user_images_from_fb($uid, $fb_user['id']))
					{
						$this->users_model->set_user_has_photo($uid, 1);
					}
				}
				$this -> users_model -> update_user_profile($uid, $update_data);
			}
		}
		$this->_add_notice('success');
		$this->_history_back();
	}

	function delete_profile_picture($uid)
	{
		if($this->tank_auth->get_user_id() == $uid)
		{
			$this->users_model->set_user_has_photo($uid, 0);
		}
		$this->_history_back();
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
			$config['upload_path'] = UPLOADS_PATH.'/users/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '2048';
			$config['max_height']  = '1024';
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
					$data['user_profile_image'] = UPLOADS_DIR.'/users/'.$user_id.'/large.png?' . time();
					$this->users_model->set_user_has_photo($user_id, 1);
				}	
				
				unlink($result['full_path']);
			}
		}		
		
		$this->load->view('ajax/user_image_upload', $data);
	}

	function ajax_already_messaged($uid)
	{
		
	}
}

/* End of file users.php */
