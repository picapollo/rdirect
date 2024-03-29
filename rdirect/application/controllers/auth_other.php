<?php

class auth_other extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('tank_auth/users_tank_auth');
	}

	// handle when users log in using facebook account
	function fb_signin()
	{
		// load facebook library
		//$this->load->library('facebook'); // this has been loaded in autoload.php

		// get the facebook user and save in the session
		
		$fb_cookie = $this->facebook->get_facebook_cookie();
		$this->facebook->setAccessToken($fb_cookie['access_token']);
		
		$fb_user = $this->facebook->api('/me');
		
		if($fb_user)
		{
			$this->session->set_userdata('facebook_id', $fb_user['id']);
			$fb_user['id'] = mysql_real_escape_string($fb_user['id']);
			$fb_user['email'] = mysql_real_escape_string($fb_user['email']);
			$user = $this -> users_model -> get_user_by_sm(array('facebook_id' => $fb_user['id']), 'facebook_id');
			if(sizeof($user) == 0)
			{
				$user = $this -> users_model -> get_user_by_email($fb_user['email']);
				if(sizeof($user) == 0)
				{
					$this->session->set_flashdata('fb_access_token', $fb_cookie['access_token']);
					//redirect('auth_other/fill_user_info', 'refresh');
					$this->fill_user_info();
				}
				else	// Email로 가입했지만 Facebook connect하지 않은 경우
				{
					//$this -> users_model -> update_user_profile($user[0] -> id, array('facebook_id' => $fb_user['facebook_id']));
					$this->_add_notice('An account with the same email address exists.<br>Please sign in and click on facebook connect.');
					redirect('login');					
				}
			}
			else
			{
				// simulate what happens in the tank auth
				$this -> session -> set_userdata(array('user_id' => $user[0] -> id, 'username' => $user[0] -> username, 'status' => ($user[0] -> activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED));
				//$this->tank_auth->clear_login_attempts($user[0]->email); can't run this when doing FB
				$this -> users_tank_auth -> update_login_info($user[0] -> id, $this -> config -> item('login_record_ip', 'tank_auth'), $this -> config -> item('login_record_time', 'tank_auth'));
				$loc_cur = $this->users_model->get_user_locale_and_currency($user[0]->id);
				$this->session->set_userdata('locale', $loc_cur->locale);
				$this->session->set_userdata('currency', $loc_cur->currency);				
				$this->_handle_redirect('home/dashboard');
			}
		}
		else
		{
			$this->_add_notice('Cannot find facebook user.');
			echo '<script type="text/javascript">history.back()</script>';
		}
	}

	// called when user logs in via facebook/twitter for the first time
	function fill_user_info()
	{
		// load validation library and rules
		$this->load->config('tank_auth', TRUE);
		
		/*$fb_token = $this->session->flashdata('fb_access_token');
		
		if(!$fb_token)
		{
			$this->_add_notice('Facebook connect failed');
			$this->_history_back();
		}
		
		$this->facebook->setAccessToken($fb_token);*/
		$fb_user = $this->facebook->api('/me');
	
		// Run the validation
		if( ! $fb_user)
		{
			$this->_add_notice('Facebook connect failed');
			$this->_history_back();
		}
		else
		{
			$username = mysql_real_escape_string($fb_user['name']);
			$email = mysql_real_escape_string($fb_user['email']);
			/*
			 * We now must create a new user in tank auth with a random password in order
			 * to insert this user and also into user profile table with tank auth id
			 */
			$password = $this -> generate_password(9, 8);
			$this -> tank_auth -> create_user($username, $email, $password, false);
			$new_user = $this -> users_model -> get_user_by_email($email);
			$user_id = $new_user[0] -> id;
			
			$university = array();
			foreach($fb_user['education'] as $i)
			{
				$university[] = $i['school']['name'];
				//TODO: 그룹 자동가입 url_title($i['school']['name'], 'dash', TRUE);
			}
			
			$this -> users_model -> update_user_profile($user_id, array(
					'facebook_id' => $fb_user['id'],
					'university' => implode(', ', $university)
				));
			$this->load->model('pictures_model');
			if($this->pictures_model->create_user_images_from_fb($user_id, $this -> session -> userdata('facebook_id')) == TRUE)
			{
				$this->users_model->set_user_has_photo($user_id, 1);
			}
			// let the user login via tank auth
			$this -> tank_auth -> login($email, $password, false, false, true);
			$this->_handle_redirect('auth');
		}
	}

	// a logout function for 3rd party
	function logout()
	{
		$redirect = site_url('auth/logout');
		if($this -> session -> userdata('gfc_id') && $this -> session -> userdata('gfc_id') != '')
		{
			$redirect = null;
		}

		// set all user data to empty
		$this -> session -> set_userdata(array('facebook_id' => '', 'twitter_id' => '', 'gfc_id' => '', 'google_open_id' => '', 'yahoo_open_id' => ''));
		if($redirect)
		{
			redirect($redirect, 'refresh');
		}
		else
		{
			$this -> load -> view('gfc_logout');
		}
	}

	// function to validate the email input field
	function email_check($email)
	{
		$user = $this -> users_model -> get_user_by_email($email);
		if(sizeof($user) > 0)
		{
			$this -> form_validation -> set_message('email_check', 'This %s is already registered.');
			return false;
		}
		else
		{
			return true;
		}
	}

	// generates a random password for the user
	function generate_password($length = 9, $strength = 0)
	{
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if($strength & 1)
		{
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if($strength & 2)
		{
			$vowels .= "AEUY";
		}
		if($strength & 4)
		{
			$consonants .= '23456789';
		}
		if($strength & 8)
		{
			$consonants .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;
		for($i = 0; $i < $length; $i++)
		{
			if($alt == 1)
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
