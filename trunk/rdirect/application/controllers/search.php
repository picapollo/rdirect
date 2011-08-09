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
		
		$this->load->view('search', $this->data);
	}
	
	function ajax_get_results(){
		$opt = $this->input->get();
		
		// for debug
		if( (empty($opt['lat']) || empty($opt['lng']))  && (empty($opt['sw_lat']) || empty($opt['sw_lng']) || empty($opt['ne_lat']) || empty($opt['ne_lng']) ))
		{
			$opt['lat'] = 36;
			$opt['lng'] = 127;
		}
		
		// TODO boundary 너무 좁은 경우 알아서 넓히기
		
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
		
		$properties = $this->search_model->search($opt);
		
		$currency_rate = $this->_generate_currency_table(CURRENT_CURRENCY);
		
		$facets = array();
		
		$facets['hosting_amenity_ids'] = array();
		$facets['room_type'] = array();
		$facets['property_type_id'] = array();
		$facets['top_amenities'] = array();
		$amenity_list = $this->rooms_model->get_amenity_list();
		$amenities = array();
		
		foreach($properties as $k => $i)
		{
			$properties[$k]->user_thumbnail_url = insert_user_photo($i->user_id, 'tiny', ! $i->user_has_photo);
			$properties[$k]->picture_ids = ! empty($i->picture_ids) ? explode(',', $i->picture_ids) : array(null);
			$properties[$k]->hosting_thumbnail_url = insert_room_photo($properties[$k]->picture_ids[0], 'x_small');
			$properties[$k]->price = round($i->price_native / (float)($currency_rate[$i->native_currency]['rate']), 0);
		}
		

		$count = count($properties);
		$res = new stdClass;		
		$res->properties = $properties;
		$res->geocode_precision = 'address';
		$res->results_count_html = "\n<b>1 &ndash; 21</b> of <b>31 listings</b>\n";
		$res->results_count_top_html = "$count results\n";
		$res->results_pagination_html = "";

		
		
		$res->cnt = $this->search_model->count_res();
		// for debug 
		$res->query = $this->db->last_query();
		
		

		echo json_encode(($res));
		
		//$this->load->view('ajax/search_results', $this->data);
	}
}

?>