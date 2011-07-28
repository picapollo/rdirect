<?php

class MY_Controller extends CI_Controller {

	public $data;

	function __construct()
	{
		parent::__construct();
		
		$lang = $this->session->userdata('locale');
		$this->load->config('language');
		
		$supported_langs = $this->config->item('supported_languages');

		// Still no Lang. Lets try some browser detection then
		if( ! $lang && ! $this->input->server('HTTP_ACCEPT_LANGUAGE'))
		{
			// explode languages into array
			$accept_langs = explode(',', $this->input->server('HTTP_ACCEPT_LANGUAGE'));

			log_message('debug', 'Checking browser languages: ' . implode(', ', $accept_langs));

			// Check them all, until we find a match
			foreach($accept_langs as $lang)
			{
				// Turn en-gb into en
				$lang = substr($lang, 0, 2);

				// Check its in the array. If so, break the loop, we have one!
				if(in_array($lang, array_keys($supported_langs)))
				{
					break;
				}
			}
		}

		// If no language has been worked out - or it is not supported - use the default
		if(!$lang or !in_array($lang, array_keys($supported_langs)))
		{
			$lang = $this->config->item('default_language');
		}

		// Whatever we decided the lang was, save it for next time to avoid working it out again
		$this->session->set_userdata('locale', $lang);

		// Set the language config. Selects the folder name from its key of 'en'
		$this->config->set_item('language', $supported_langs[$lang]['folder']);

		// Sets a constant to use throughout ALL of CI.
		define('CURRENT_LANGUAGE', $lang);
		
		$this -> data = array();
		$this -> data['header'] = array();
		$this -> data['header']['title'] = 'RDirect';
		$this -> data['header']['description'] = 'Default description';
		$this -> data['header']['locale'] = CURRENT_LANGUAGE;
		
		$this->load->language('common');
		
		$this->data['starred'] = $this->users_model->get_starred_rooms($this->tank_auth->get_user_id());
	}

	function _add_notice($message)
	{
		if(is_array($message))
		{
			$message = implode("<br>", $message);
		}
		$old_notice = $this -> session -> userdata('notice');
		print_r($old_notice);
		if($old_notice)
			$old_notice .= '<br>';
		$this -> session -> set_userdata('notice', $old_notice . $message);
	}

	function _dump_post()
	{
		echo '<pre>';
		foreach($_POST as $key => $value) {
			$value = $this->input->post($key);
			echo '<br>'.$key.' : ';
			print_r($value);
		}
		echo '</pre>';
	}
	
	function _dump_get()
	{
		echo '<pre>';
		foreach($_GET as $key => $value) {
			$value = $this->input->post($key);
			echo '<br>'.$key.' : ';
			print_r($value);
		}
		echo '</pre>';		
	}

	function _handle_redirect($redirect_default='', $new_params = array())
	{
		$redirect_params = $this->input->post('redirect_params');
		if( ! $redirect_params || ! isset($redirect_params['action']) || empty($redirect_params['action']))
			redirect($redirect_default);
		
		if( ! isset($redirect_params['controller']) || empty($redirect_params['controller']))
			$redirect_params['controller'] = strtolower($this->router->fetch_class());
		
		$controller = $redirect_params['controller'];
		$action = $redirect_params['action'];
		
		$redirect_params = array_merge($redirect_params, $new_params);
		
		if(isset($redirect_params['id'])){
			$action .= '/'.$redirect_params['id'];
			unset($redirect_params['id']);
		}
		
		unset($redirect_params['controller']);
		unset($redirect_params['action']);
		
		$trace=debug_backtrace();
		$caller=array_shift($trace);
		
		log_message('debug', 'Redirect: called by'.$caller["function"].' : '.$controller.'/'.$action.'?'.http_build_query($redirect_params));
		redirect($controller.'/'.$action.'?'.http_build_query($redirect_params));
	}
	
	function _history_back($exit = TRUE){
		echo '<script type="text/javascript">history.back()</script>';
		exit();
	}
}

// End of MY_Controller.php
