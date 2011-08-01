<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Calendar extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->library('calendar');
		$this->load->helper('date');
		$this->load->model('rooms_model');
		$this->load->model('calendar_model');
	}	
	
	/*
	 *	선택한 월 2주 전후 날짜, 캘린더 시작/종료 인덱스 계산
	 */
	function _get_date_boundary($month, $year)
	{
		$next_month = $month==12 ? 1 : $month+1;
		$next_month_year = $month==12? $year+1 : $year;
		
		$starting_day = date('w', mktime(0, 0, 0, $month, 1, $year));
		$prev_days = $starting_day + 14;
		$after_days = 20 - date('w', mktime(0, 0, 0, $next_month, 1, $next_year));
		
		$res = stdClass();
		$res->start_date = date("Y-m-d", strtotime("$year-$month-01 - $prev_days day"));
		$res->end_date = date("Y-m-d", strtotime("$next_year-$next_month-01 + $after_days day"));
		$res->start_idx = 14;
		$res->end_idx = (days_in_month($month, $year)+$starting_day)<=28 ? 49 : 42;
	}
	
	/*
	 * 캘린더 수정 화면 표시
	 */
	function single($rid)
	{
		$this->load->model('rooms_model');
		if( ! $rid || $rid != mysql_real_escape_string($rid) || 
			! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()) )
		{
			redirect('');
		}
		
		$month = $this->input->get('month') ? $this->input->get('month') : date('m');
		$year = $this->input->get('year') ? $this->input->get('year') : date('Y');
		
		// 방 정보 가져오기
		$res = $this->rooms_model->get_room($rid);
		if(empty($res)) show_404();
		$this->data['room'] = $res[0]; 
		
		// 방 활성화\비활성화 위한 키 생성
		$this->load->library('encrypt');
		$this->data['sig'] = $this->encrypt->sha1($this->tank_auth->get_user_id().$this->input->server('REMOTE_ADDR'));
		
		$boundary = $this->_get_date_boundary($month, $year);
		
		$this->data['tiles'] = $this->calendar_model->get_tiles_full($rid, $boundary->start_date, $boundary->stop_date);
		$this->data['start_date'] = $boundary->start_date;
		$this->data['stop_date'] = $boundary->stop_date;
		$this->data['start_idx'] = $boundary->start_idx;
		$this->data['stop_idx'] = $boundary->stop_idx;
		$this->data['month'] = $month;
		$this->data['year'] = $year;

		$this->load->view('calendar/single', $this->data);
	}
	
	function modify_calendar(){
		$this->load->model('rooms_model');
		$rid = $this->input->post('hosting_ide');
		if( ! $rid || $rid != mysql_real_escape_string($rid) || 
			! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()) )
		{
			redirect('');
		}

		$month = $this->input->get('month') ? $this->input->get('month') : date('m');
		$year = $this->input->get('year') ? $this->input->get('year') : date('Y');	
		
		$post = $this->input->post();
		
	}
}

/* End of file calendar.php */
