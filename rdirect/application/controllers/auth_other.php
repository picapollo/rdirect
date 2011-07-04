<?php

class auth_other extends CI_Controller 
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('tank_auth/users_tank_auth');

		// for google open id
        parse_str($_SERVER['QUERY_STRING'],$_GET);		
	}
	
	// handle when users log in using facebook account
	function fb_signin()
	{
		// load facebook library
		//$this->load->library('facebook'); // this has been loaded in autoload.php
		
		// get the facebook user and save in the session
		$fb_user = $this->facebook->getUser();
		if( isset($fb_user))
		{
			$this->session->set_userdata('facebook_id', $fb_user['id']);
			$user = $this->user_model->get_user_by_sm(array('facebook_id' => $fb_user['id']), 'facebook_id');
			if( sizeof($user) == 0) 
			{ 
				redirect('auth_other/fill_user_info', 'refresh'); 
			}
			else
			{
				// simulate what happens in the tank auth
				$this->session->set_userdata(array(	'user_id' => $user[0]->id, 'username' => $user[0]->username,
													'status' => ($user[0]->activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED));
				//$this->tank_auth->clear_login_attempts($user[0]->email); can't run this when doing FB
				$this->users_tank_auth->update_login_info( $user[0]->id, $this->config->item('login_record_ip', 'tank_auth'), 
												 $this->config->item('login_record_time', 'tank_auth'));
				redirect('auth', 'refresh');
			}
		}
		else 
		{ 
			echo 'cannot find the Facebook user'; 
		}
	}
	
	// called when user logs in via facebook/twitter for the first time
	function fill_user_info()
	{
		// load validation library and rules
		$this->load->config('tank_auth', TRUE);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
		
		// Run the validation
		if ($this->form_validation->run() == false ) 
		{
			$this->load->view('auth_other/fill_user_info'); 
		}
		else
		{
			$username = mysql_real_escape_string($this->input->post('username'));
			$email = mysql_real_escape_string($this->input->post('email'));
			
			/*
			 * We now must create a new user in tank auth with a random password in order
			 * to insert this user and also into user profile table with tank auth id
			 */
			$password = $this->generate_password(9, 8);
			$this->tank_auth->create_user($username, $email, $password, false);
			$new_user = $this->user_model->get_user_by_email($email);
			$user_id = $new_user[0]->id;
			if( $this->session->userdata('facebook_id')) 
			{ 
				$this->user_model->update_user_profile($user_id, array('facebook_id' => $this->session->userdata('facebook_id')));
			}
			else if( $this->session->userdata('twitter_id'))
			{
				$this->user_model->update_user_profile($user_id, array('twitter_id' => $this->session->userdata('twitter_id')));
			}
			else if( $this->session->userdata('gfc_id'))
			{
				$this->user_model->update_user_profile($user_id, array('gfc_id' => $this->session->userdata('gfc_id')));
			}
			else if( $this->session->userdata('google_open_id'))
			{
				$this->user_model->update_user_profile($user_id, array('google_open_id' => $this->session->userdata('google_open_id')));
			}
			else if( $this->session->userdata('yahoo_open_id'))
			{
				$this->user_model->update_user_profile($user_id, array('yahoo_open_id' => $this->session->userdata('yahoo_open_id')));
			}			
			// let the user login via tank auth
			$this->tank_auth->login($email, $password, false, false, true);
			redirect('auth', 'refresh');
		}
	}
	
	// a logout function for 3rd party
	function logout()
	{
		$redirect = site_url('auth/logout');
		if( $this->session->userdata('gfc_id') && $this->session->userdata('gfc_id') != '') { $redirect = null; }
		
		// set all user data to empty
		$this->session->set_userdata(array('facebook_id' => '', 
										   'twitter_id' => '', 
										   'gfc_id' => '',
										   'google_open_id' => '',
										   'yahoo_open_id' => ''));
		if( $redirect ) { redirect($redirect, 'refresh'); } 
		else { $this->load->view('gfc_logout'); }
	}
		
	// function to validate the email input field
	function email_check($email)
	{
		$user = $this->user_model->get_user_by_email($email);
		if ( sizeof($user) > 0) 
		{
			$this->form_validation->set_message('email_check', 'This %s is already registered.');
			return false;
		}
		else { return true; }
	}
	
	// generates a random password for the user
	function generate_password($length=9, $strength=0) 
	{
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) { $consonants .= 'BDGHJLMNPQRSTVWXZ'; }
		if ($strength & 2) { $vowels .= "AEUY"; }
		if ($strength & 4) { $consonants .= '23456789'; }
		if ($strength & 8) { $consonants .= '@#$%'; }
	 
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) 
		{
			if ($alt == 1) 
			{
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} 
			else 
			{
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
}

/* End of file main.php */
/* Location: ./freally_app/controllers/main.php */