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
		$this -> data['notices'] = array();
		$this -> data['notices']['notice'] = array();
		$this -> data['header']['locale'] = CURRENT_LANGUAGE;
		
		$this->load->language('common');
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

}

// End of MY_Controller.php
