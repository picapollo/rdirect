<?php

class Search extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('search_model');
		$this->load->model('rooms_model');
		$this->load->language('hosting/amenities');
		
	}
	
	function index(){
		$g = $this->input->get();
		
		$opt = new stdClass;
		if( true )	// SET DEFAULT
		{
			$opt->lat = 37.3056;
			$opt->lng = 126.5427;
			//$opt->location = '';
			$opt->zoom = 12;
		}
		
		$opt_if_modified = new stdClass;
		foreach ($opt as $property => $value)
	    {
	        $opt_if_modified->$property = $value;
	    }
		/*$opt_if_modified->action = "ajax_get_results";
		$opt_if_modified->new_search = "true";
		$opt_if_modified->controller = "search";*/
		
		$this->data['opt'] = $opt;
		$this->data['opt_if_modified'] = $opt_if_modified; 	
		
		$this->data['amenity_list'] = $this->rooms_model->get_amenity_list();
		
		switch(CURRENT_CURRENCY)
		{
			case 'KRW':
				$this->data['min_price'] = 10000;
				$this->data['max_price'] = 250000;
				$this->data['min_price_monthly'] = 150000;
				$this->data['max_price_monthly'] = 4000000;
				break;
			case 'CNY':
				$this->data['min_price'] = 100;
				$this->data['max_price'] = 3000;
				$this->data['min_price_monthly'] = 1500;
				$this->data['max_price_monthly'] = 50000;
				break;
			case 'JPY':
				$this->data['min_price'] = 1000;
				$this->data['max_price'] = 25000;
				$this->data['min_price_monthly'] = 15000;
				$this->data['max_price_monthly'] = 400000;
				break;
			case 'USD':
			default:
				$this->data['min_price'] = 10;
				$this->data['max_price'] = 300;
				$this->data['min_price_monthly'] = 150;
				$this->data['max_price_monthly'] = 5000;
				break;
		}
		
		$this->load->view('search', $this->data);
	}
	
	function ajax_get_results(){
		$opt = $this->input->get(null, true);
		
		$res = new stdClass;
		$res->debug = new stdClass;
		
		// for debug
		if( (empty($opt['lat']) || empty($opt['lng']))  && (empty($opt['sw_lat']) || empty($opt['sw_lng']) || empty($opt['ne_lat']) || empty($opt['ne_lng']) ))
		{
			$opt['lat'] = 37.3056;
			$opt['lng'] = 126.5427;
		}

		// 지도 검색 범위 지정되지 않은 경우 알아서 지정 //TODO: 검색결과에 맞춰서 조절
		if( empty($opt['sw_lat']) || empty($opt['sw_lng']) || empty($opt['ne_lat']) || empty($opt['ne_lng']))
		{
			$dist_limit = 1000;
			$dist_unit = 69;
			$opt['sw_lat'] = $opt['lat'] - $dist_limit / abs(cos(deg2rad($opt['lat'])) * $dist_unit);
			$opt['ne_lat'] = $opt['lat'] - $dist_limit / abs(cos(deg2rad($opt['lat'])) * $dist_unit);
			$opt['sw_lng'] = $opt['lng'] - ($dist_limit / $dist_unit);
			$opt['ne_lng'] = $opt['lng'] - ($dist_limit / $dist_unit);
		}
		
		// boundary 너무 좁은 경우 알아서 넓히기
		if($opt['ne_lat'] - $opt['sw_lat'] < 0.01)
		{
			$opt['ne_lat'] += 0.05;
			$opt['sw_lat'] -= 0.05;
		}
		
		if($opt['ne_lng'] > $opt['sw_lat'] && $opt['ne_lng'] - $opt['sw_lng'] < 0.01)
		{
			$opt['ne_lng'] += 0.05;
			$opt['sw_lng'] -= 0.05;
		}

		$opt['limit_offset'] = ($opt['page'] - 1) * $opt['per_page'];
		
		switch(CURRENT_LANGUAGE){
			case 'en':
				$date_pattern = '/\d{1,2}\/\d{1,2}\/\d{4,4}/';
				break;
			case 'ko':
			case 'ja':
				$date_pattern = '/\d{4,4}\/\d{1,2}\/\d{1,2}/';
				break;
			case 'zh':
				$date_pattern =  '/\d{4,4}-\d{1,2}-\d{1,2}/';
				break;
			default:
		} 
		
		$res->debug->pattern = $date_pattern;
		$res->debug->lang = CURRENT_LANGUAGE;

		$res->debug->opt_orig = $opt;
		if( isset($opt['checkin']) && ! preg_match($date_pattern, $opt['checkin'])) 	unset($opt['checkin']);
		if( isset($opt['checkout']) && ! preg_match($date_pattern, $opt['checkout']))	unset($opt['checkout']);
		
		$res->debug->opt = $opt;
		
		$this->search_model->generate_options($opt);
		$properties = $this->search_model->search();
		
		$res->query = $this->db->last_query();
		
		$count_all = $this->search_model->count_all();
		$count_all = $count_all[0]->count_all;
		
		$currency_rate = $this->_generate_currency_table(CURRENT_CURRENCY);
		
		foreach($properties as $k => $i)
		{
			$properties[$k]->user_thumbnail_url = insert_user_photo($i->user_id, 'tiny', ! $i->user_has_photo);
			$properties[$k]->picture_ids = ! empty($i->picture_ids) ? explode(',', $i->picture_ids) : array(null);
			$properties[$k]->hosting_thumbnail_url = insert_room_photo($properties[$k]->picture_ids[0], 'x_small');
			$properties[$k]->price = round($i->price_native / (float)($currency_rate[$i->native_currency]['rate']), 0);
		}
		
		$facets = array();
		
		// count amenities in entire search result
		$amenity_list = $this->rooms_model->get_amenity_list();
		$amenities_count_raw = $this->search_model->count_amenities();
		$amenities_count = array();
		foreach($amenities_count_raw as $k => $i)
			$amenities_count[$i->amenity_id] = $i->count;
		
		$facets['hosting_amenity_ids'] = array();
		$facets['top_amenities'] = array(array(0, array(0, -1)), array(0, array(0, -1)), array(0, array(0, -1)));
		foreach($amenity_list as $k => $i){
			if(empty($amenities_count[$k])) $amenities_count[$k] = 0;
			$tmp = array($k, array(lang('amenity_'.$i->name), $amenities_count[$k]));
			$facets['hosting_amenity_ids'][] = $tmp;
			
			// Caculate top three amenities
			if( $amenities_count[$k] > $facets['top_amenities'][2][1][1])
			{
				for($j=2; $j>0 && $amenities_count[$k] > $facets['top_amenities'][$j-1][1][1]; $j--)
				{
					$facets['top_amenities'][$j] = $facets['top_amenities'][$j-1];
				}
				$facets['top_amenities'][$j] = $tmp;
			}
		}
		
		// count property types in entire search result
		$property_type_list = $this->rooms_model->get_property_type_list();
		$property_type_count_raw = $this->search_model->count_property_types();
		$property_type_count = array();
		foreach($property_type_count_raw as $k => $i)
			$property_type_count[$i->property_type_id] = $i->count;
		
		$facets['property_type_id'] = array();
		foreach($property_type_list as $k => $i)
			$facets['property_type_id'][] = array($k, array(lang('property_type_'.$i), (empty($property_type_count[$k])?0:$property_type_count[$k])));
		
		// count room types in entire search result
		$facets['room_type'] = array();
		$room_type_count = $this->search_model->count_room_types();
		foreach($room_type_count as $i)
		{
			$facets['room_type'][] = array($i->room_type, array(lang('room_type_'.$i->room_type), $i->count));
		}
			
		
		$page_start = $opt['limit_offset'] + 1;
		$count_page = $page_start + count($properties) - 1;
		
		$page_total = ceil($count_all / $opt['per_page']);
		
			
		$res->properties = $properties;
		$res->geocode_precision = 'address';
		$res->results_count_html = "\n<b>{$page_start}&ndash; $count_page</b> of <b>{$count_all} listings</b>\n";
		$res->results_count_top_html = "{$count_all} results\n";
		$res->results_pagination_html = $this->_generate_pagination($opt, $opt['page'], $page_total);
		$res->sort = empty($opt['sort']) ? 0 : $opt['sort'];
		$res->view_type = empty($opt['search_view'])? 0 : $opt['search_view'];
		$res->facets = $facets;

		echo json_encode($res);
	}

	function _build_http_query_by_page($opt, $page)
	{
		$opt['page'] = $page;
		return http_build_query($opt);
	}

	function _generate_pagination($opt, $current_page, $page_total)
	{
		if($page_total <= 1) return '';
		
		if($current_page > 6)
			$start_page = $current_page - 3;
		else
			$start_page = 2;
		
		if($current_page + 6 < $page_total)
			$end_page = $current_page + 3;
		else
			$end_page = $page_total - 1;
		
		$res  =	'<div class="pagination">';
		
		if($current_page > 1)
		{
			$res .= '<a href="/search?'.$this->_build_http_query_by_page($opt, $current_page-1).'" class="prev_page" rel="prev'.($current_page==2?' start':'').'"><</a>';
		} 
		
		if($current_page == 1)
			$res .= '<span class="current">1</span>';
		else
			$res .= '<a href="/search?'.$this->_build_http_query_by_page($opt, 1).'" rel="'.($current_page==2?'prev ':'').'start">1</a>';
			
		
		if($start_page != 2)
		{
			$res .= '<span class="gap">...</span>';
		}
	
	 	for($i = $start_page; $i <= $end_page; $i++)
		{
			if($i == $current_page)
			{	
				$res .= "<span class=\"current\">{$i}</span>";
			}
	 		else
	 		{ 
				$res .= '<a href="/search?'.$this->_build_http_query_by_page($opt, $i).'" ';
				$res .= ($i == $current_page+1 ? 'rel="next"' : ($i == $current_page-1 ?'rel="prev"':'')) . ">{$i}</a>";
			}			
		}
		
		if($end_page != $page_total - 1)
		{
			$res .= '<span class="gap">...</span>';
		}
		
		if($current_page == $page_total)
			$res .= '<span class="current">'.$page_total.'</span>';
		else
			$res .= '<a href="/search?'.$this->_build_http_query_by_page($opt, $page_total).'">'.$page_total.'</a>';
		

	 	if($current_page < $page_total)
		{
			$res .= '<a href="/search?'.$this->_build_http_query_by_page($opt, $current_page+1).'" class="next_page" rel="next">></a>';
		} 
		
		return $res.'</div>';
	}
}

?>