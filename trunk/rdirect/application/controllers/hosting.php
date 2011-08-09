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
		echo "<pre>\n";
		print_r($this->_generate_weekly_table());
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
		
		
		$this->data['weekly'] = $this->_generate_weekly_table();
		
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
	
	/*
	 * 주간 가격 설정 날짜 테이블 생성
	 */
	function _generate_weekly_table(){
		// 오늘이 끼어있는 주부터 시작
		$start = $this->_get_first_day_of_week(time());
		
		
		$res = array();
		
		// TODO: translation
		$seasons = array('Winter', 'Spring', 'Summer', 'Autumn', 'Winter'); 

		$i = $start;
		
		for($s=0; $s<5; $s++)
		{
			$row = new stdClass;
			
			$t = strtotime('+'.($s*3).' month', mktime(0, 0, 0, date('m'), 1, date('Y')));
			$season_num = (date('m', $t)+1)/4 % 4;
			$season_label = $seasons[$season_num];
			$row->label = $season_label.date(' Y', $t);

			$row->data = array();
			
			$end = mktime(0, 0, 0, ($season_num+2)*3, 20, date('Y', $t));

			for ($cnt=0; $cnt < 13 && $i < $end; $i += 604800, $cnt++)	// 1주일씩 증가
			{
				$tmp = new stdClass;
				
				$tmp->date = date('Y-m-j', $i);
				
				$six_days_later = $i + 518400;
				
				$month_start = date('M', $i);
				$month_end = date('M', $six_days_later);
					
				if($month_start == $month_end)
					$tmp->label = $month_start . ' '. date('j', $i). '-'.date('j', $six_days_later);
				else
					$tmp->label = $month_start.' '.date('j',$i).' - '.$month_end.' '.date('j', $six_days_later);
				
				$row->data[] = $tmp;
			}
			$res[] = $row;
		}
		
		return $res;
	}
	
	function _generate_monthly_table(){
		
	}
	
	/**
	 * 해당 주의 첫 날을 반환
	 * @param timestamp/string	date
	 * @param string			반환받을 형식, null이면 timestamp로 반환
	 */ 
	function _get_first_day_of_week($d, $return_format=null){
		if( ! is_numeric($d))
			$d = strtotime($d);
		$res = strtotime('-'.date('w', $d).' day', $d);
		if( ! $return_format)
			return $res;
		else
			return date($return_format, $res); 
	}
}

/* End of file hosting.php */
