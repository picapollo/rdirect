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
		$after_days = 20 - date('w', mktime(0, 0, 0, $next_month, 1, $next_month_year));
		
		$res->start_date = date("Y-m-d", strtotime("$year-$month-01 - $prev_days day"));
		$res->stop_date = date("Y-m-d", strtotime("$next_month_year-$next_month-01 + $after_days day"));
		$res->start_idx = 14;
		$res->stop_idx = (days_in_month($month, $year)+$starting_day)<=28 ? 42 : 48;
		
		return $res;
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
		
		$this->data['calendar'] = $this->_generate_calendar($month, $year);
		$this->data['tiles'] = $this->_generate_tiles_full($rid, $boundary);
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
		$rid = $this->input->post('hosting_id');
		if( ! $rid || $rid != mysql_real_escape_string($rid) || 
			! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()) )
		{
			die('error');
		}

		$month = $this->input->get('month') ? $this->input->get('month') : date('m');
		$year = $this->input->get('year') ? $this->input->get('year') : date('Y');
		
		$post = $this->input->post();
		
		$dates = array();
		for($i = strtotime($post['starting_date']); $i <= strtotime($post['stopping_date']); $i = strtotime(' +1 day', $i))
			$dates[] = date('Y-m-d', $i);
		
		$this->calendar_model->update_dates($rid, $dates, $post['availability']=='Available'?1:0, $post['daily_price_native']);
		$this->db->last_query();
		
		
		$tiles = $this->_generate_tiles_full($rid, $this->_get_date_boundary($month, $year));
		header('Content-type: text/javascript');
		echo 'update_calendar_data(0, '.$rid.', eval([' . json_encode($tiles) . ']));';
		echo "\n".'after_submit();';
	}
	
	/*
	 * 캘린더에 붙일 타일 생성
	 */
	function _generate_tiles_full($rid, $boundary)
	{
		$dates = $this->calendar_model->get_tiles_full($rid, $boundary->start_date, $boundary->stop_date);
		if( ! $dates) $dates = array();
		//$tile_count = floor((strtotime($boundary->stop_date) - strtotime($boundary->start_date))/86400);
		$date_idx = 0;
		$tiles = array();
		
		/*
		 *	타일들 생성
		 */
		for($i = strtotime($boundary->start_date); $i <= strtotime($boundary->stop_date); $i=strtotime('+1 day', $i))
		{
			if(isset($dates[$date_idx]) && strtotime($dates[$date_idx]->date) == $i)
			{
				$dates[$date_idx]->cl = $dates[$date_idx]->isa==1 ? 'av' : 'bs';
				$dates[$date_idx]->st = $dates[$date_idx]->isa==1 ? 0 : 2;
				unset($dates[$date_idx]->date);
				if($dates[$date_idx]->daily_price == 0) unset($dates[$date_idx]->daily_price);
				$tiles[] = $dates[$date_idx];
				$date_idx++;
			}
			else
			{
				$tmp = new stdClass;
				$tmp->cl = 'av';
				$tmp->isa = 1;
				$tiles[] = $tmp;
			}
		}

		// 타일들 왼쪽, 오른쪽 정해주기
		$tiles[0]->sty = 0;
		for($i=1; $i<count($tiles);  $i++)
		{
			if($tiles[$i]->cl != $tiles[$i-1]->cl || 
				(isset($tiles[$i]->daily_price) && ! isset($tiles[$i-1]->daily_price)) ||
				( ! isset($tiles[$i]->daily_price) && isset($tiles[$i-1]->daily_price)) ||
				(isset($tiles[$i]->daily_price) && isset($tiles[$i-1]->daily_price) && $tiles[$i]->daily_price != $tiles[$i-1]->daily_price) 
			){
				$tiles[$i]->sty = 1;
				$tiles[$i-1]->sty += 2; 
			}
			else
			{
				$tiles[$i]->sty = 0;
			}
		}
		
		// 숫자로 된 sty 문자열로 변환
		$styles = array('both', 'left', 'right', 'single');
		foreach($tiles as $k=>$tile)
		{
			$tiles[$k]->sty = $styles[$tile->sty];
		}
		
		return $tiles;
	}

	function _generate_calendar($month, $year)
	{
		$prev_month = ($month==1) ? 12 : $month-1;
		$prev_month_year = ($month==1) ? $year-1 : $year;
		$prev_month_days = days_in_month($prev_month, $prev_month_year);
		$next_month = ($month==12) ? 1 : $month+1;
		$next_month_year = ($month==12) ? $year+1 : $year;
		$next_month_days = days_in_month($prev_month, $prev_month_year);

		$month_days = days_in_month($month, $year);
		$start_day = date('w', mktime(0,0,0, $month, 1, $year));
		$last_day = date('w', mktime(0,0,0, $month, $month_days, $year));
		$today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$calendar = array();
		
		// 저번달
		for($i=$prev_month_days - $start_day + 1; $i <= $prev_month_days; $i++)
		{
			$d = new stdClass;
			$d->d = $i;
			$d->disabled = mktime(0, 0, 0, $prev_month, $i, $prev_month_year) < $today;
			$calendar[] = $d;
		}
		
		// 이번달
		for($i=1; $i <= $month_days; $i++)
		{
			$d = new stdClass;
			$d->d = $i;
			$d->disabled = mktime(0, 0, 0, $month, $i, $year) < $today;
			$calendar[] = $d;
		}
		
		// 다음달
		for($i = 1 ; $i < 7 - $last_day; $i++){
			$d = new stdClass;
			$d->d = $i;
			$d->disabled = mktime(0, 0, 0, $next_month, $i, $next_month_year) < $today;
			$calendar[] = $d;
		} 
		
		return $calendar;
	}

	function index(){
		echo '<pre>';
		print_r($this->_generate_calendar(8, 2011));
	}
}

/* End of file calendar.php */
