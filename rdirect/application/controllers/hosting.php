<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Hosting extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}
	
	function index(){
		
	}
	
	function pricing(){
		$rid = $this->input->get('hosting_id');
		$this->load->model('rooms_model');
		if( ! $rid || $rid != mysql_real_escape_string($rid) || 
			! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()) )
		{
			redirect('');
		}
		
		$this->load->language('hosting/pricing');
		
		// 방 정보 가져오기
		$res = $this->rooms_model->get_room($rid);
		if(empty($res)) show_404();
		$this->data['room'] = $res[0];
		
		$currency_config = $this->config->item('supported_currency');
		$this->data['room']->currency_symbol = $currency_config[$this->data['room']->native_currency]['symbol'];
		 
		// 방 활성화\비활성화 위한 키 생성
		$this->load->library('encrypt');
		$this->data['sig'] = $this->encrypt->sha1($this->tank_auth->get_user_id().$this->input->server('REMOTE_ADDR'));
		$this->data['currency'] = $this->_generate_currency_table();
		
		// TODO: 캘린더에서 입력한 일 단위 일정 가져오기
		
		$this->load->view('hosting/pricing', $this->data);
	}
		
	/**
	 * 예약관리
	 */
	function my_listings(){
		
	}
	
	function ajax_update_daily_pricing(){
		
	}
	
	function ajax_save_pricing_subsection(){
		$rid = $this->input->get('hosting_id');
		$section = $this->input->get('section');
	}
	
	function ajax_price_check(){
		
	}
	
	function _generate_weekly_table(){
		
	}
	
	function _generate_monthly_table(){
		
	}
}

/* End of file hosting.php */
