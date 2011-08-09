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
		if( ! $lang && $this->input->server('HTTP_ACCEPT_LANGUAGE'))
		{
			// explode languages into array
			$accept_langs = explode(',', $this->input->server('HTTP_ACCEPT_LANGUAGE'));

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

		// Set the language config. Selects the folder name from its key of 'en'
		$this->config->set_item('language', $supported_langs[$lang]['folder']);

		// Sets a constant to use throughout ALL of CI.
		define('CURRENT_LANGUAGE', $lang);
		define('CURRENT_LANGUAGE_CODE', $supported_langs[CURRENT_LANGUAGE]['lang_code']);
		
		$supported_cur = $this->config->item('supported_currency');
		$currency = $this->session->userdata('currency');
		if( ! $currency)
			$currency = $supported_langs[CURRENT_LANGUAGE]['currency'];
		
		define('CURRENT_CURRENCY', $currency);
		define('CURRENT_CURRENCY_SYMBOL', $supported_cur[CURRENT_CURRENCY]['symbol']);
		
				// Whatever we decided the lang was, save it for next time to avoid working it out again
		$this->session->set_userdata('locale', $lang);
		$this->session->set_userdata('currency', $currency);
		
		$this -> data = array();
		$this -> data['header'] = array();
		$this -> data['header']['title'] = 'RDirect';
		$this -> data['header']['description'] = 'Default description';
		
		$this->load->language('common');
		
		if($this->tank_auth->is_logged_in())
		{
			$starred = $this->users_model->get_starred_rooms($this->tank_auth->get_user_id());
		}
		
		if(empty($starred))
		{
			$starred = array();
			$starred[0] = new stdClass;
			$starred[0]->count = 0;
			$starred[0]->room_ids = array();	
		}
		$this->data['starred'] = $starred[0];
		
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
		if( ! $redirect_params)
		{
			// 세션에서 redirect_params 가져오기
			$rp_keys = $this->session->userdata('rp_keys');
			$this->session->unset_userdata('rp_keys');
			if($rp_keys)
			{
				$rp_keys = explode(';', $rp_keys);
				$redirect_params = array();
				foreach($rp_keys as $k)
				{
					$redirect_params[$k] = $this->session->userdata($k);
					error_log(get_class($this). ' -> ' . $k .' : ' . $this->session->userdata($k));
					$this->session->unset_userdata($k);
				}
			} 
		}
		
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
		$caller=array_shift(array_shift($trace));
		
		error_log('Redirect: called by '.$caller["function"].' : '.$controller.'/'.$action.'?'.http_build_query($redirect_params));
		redirect($controller.'/'.$action.'?'.http_build_query($redirect_params));
	}
	
	function _history_back($exit = TRUE){
		echo '<script type="text/javascript">history.back()</script>';
		exit();
	}
	
	/*
	 *	구글에서 환율정보 받아와서 테이블 생성
	 *  TODO: 매번 동적으로 생성하지 말고 하루에 한번 Cron으로 받아와서 JSON 등으로 저장  
	 */
	function _generate_currency_table($from='USD'){
		$res = array();
		$this->load->library('currency');
		
		// 매번 긁어오면 느려서 일단 테스트용 임시 환율
		$res = json_decode('{"USD":{"USD":{"name":"United Status Dollars","symbol":"$","rate":"1"},"KRW":{"name":"\uc6d0","symbol":"\u20a9","rate":"1067.23586"},"JPY":{"name":"\u5186","symbol":"\u00a5","rate":"78.0822987"},"CNY":{"name":"\u5143","symbol":"\u00a5","rate":"6.44010381"}},"KRW":{"USD":{"name":"United Status Dollars","symbol":"$","rate":"0.000937"},"KRW":{"name":"\uc6d0","symbol":"\u20a9","rate":"1"},"JPY":{"name":"\u5186","symbol":"\u00a5","rate":"0.0730069493"},"CNY":{"name":"\u5143","symbol":"\u00a5","rate":"0.00600907467"}},"JPY":{"USD":{"name":"United Status Dollars","symbol":"$","rate":"0.012807"},"KRW":{"name":"\uc6d0","symbol":"\u20a9","rate":"13.6318036"},"JPY":{"name":"\u5186","symbol":"\u00a5","rate":"1"},"CNY":{"name":"\u5143","symbol":"\u00a5","rate":"0.0823082559"}},"CNY":{"USD":{"name":"United Status Dollars","symbol":"$","rate":"0.155277"},"KRW":{"name":"\uc6d0","symbol":"\u20a9","rate":"165.717182"},"JPY":{"name":"\u5186","symbol":"\u00a5","rate":"12.1566586"},"CNY":{"name":"\u5143","symbol":"\u00a5","rate":"1"}}}', true);
		
		/*foreach($this->config->item('supported_currency') as $k => $a)
		{
			$res[$k] = array(
				'name' => $a['name'],
				'symbol' => $a['symbol'],
				'rate' => $this->currency->convert(1, $from, $k) 
			);
		}*/
		return $res[$from];
	}
	
	function _convert_price_to_current_currency($price, $native_currency)
	{
		$this->load->library('currency');
		return $this->currency->convert($price, $native_currency, CURRENT_CURRENCY);
	}
	
	function _get_currency_rate($native_currency)
	{
		$this->load->libary('currency');
		return $this->currency->convert(1, $native_currency, CURRENCT_CURRENCY);
	}
}

// End of MY_Controller.php
