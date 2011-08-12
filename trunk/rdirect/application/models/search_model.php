<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
	
	var $opt_generated = false;
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	/**
	 * Must be called before calling other 
	 */
	function generate_options($opt)
	{
		$r = $this->db->dbprefix('rooms');
		$u = $this->db->dbprefix('users');
		$raddr = $this->db->dbprefix('room_addresses');
		$rp = $this->db->dbprefix('room_photos');
		$rd = $this->db->dbprefix('room_descriptions');
		$cd = $this->db->dbprefix('calendar_daily');
		
		$room_photo_only = false; 
		
		$this->db->start_cache();
		$this->db->from('rooms');
		$this->db->join('room_addresses', 'room_addresses.room_id = rooms.id', 'inner');
		$this->db->join('room_photos', 'room_photos.room_id = rooms.id', $room_photo_only ? 'inner' : 'left');
		
		// 지도검색 범위 너무 크면 경도값 범위 역전 현상 발생 -> 보정
		if($opt['sw_lng'] > $opt['ne_lng'])
			$this->db->where("(lng > {$opt['sw_lng']} OR lng < {$opt['ne_lng']})");
		else
			$this->db->where("lng BETWEEN '{$opt['sw_lng']}' AND '{$opt['ne_lng']}'");
		
		$this->db->where("lat BETWEEN '{$opt['sw_lat']}' AND '{$opt['ne_lat']}'");
		
		if( ! empty($opt['price_min'])) $this->db->where('price_native >=', $opt['price_min']);
		if( ! empty($opt['price_max']))	$this->db->where('price_native <=', $opt['price_max']);
		
		if( ! empty($opt['min_bedrooms'])) $this->db->where('bedrooms >=', $opt['min_bedrooms']);
		if( ! empty($opt['min_beds'])) $this->db->where('beds >=', $opt['min_beds']);
		if( ! empty($opt['guests'])) $this->db->where('person_capacity >=', $opt['guests']);
		if( ! empty($opt['room_types'])) $this->db->where_in('room_type', $opt['room_types']);
		if( ! empty($opt['hosting_amenities']))
		{
			$amenities = 0;
			foreach($opt['hosting_amenities'] as $i)
			{
				$amenities |= 1 << ($i-1);
			}
			$this->db->where("amenities & $amenities >= $amenities");
		}
		
		if( ! empty($opt['checkin']) && ! empty($opt['checkout']))
		{
			$stay_days = (strtotime($opt['checkout'])-strtotime($opt['checkin'])) / (3600 * 24);
			$this->db->where('min_nights <=', $stay_days);
			$this->db->where('max_nights >=', $stay_days); 
			$this->db->where("(SELECT COUNT(`id`) FROM `$cd` AS cd WHERE cd.`available`=0 AND cd.`room_id` = `$r`.`id` AND cd.`date` >= '{$opt['checkin']}' AND cd.`date` <= '{$opt['checkout']}') = 0", null, false);
		}
		
		$this->db->limit($opt['per_page'], $opt['limit_offset']);
		
		$this->db->stop_cache();
		$this->opt_generated = true;
	}

	function reset_options(){
		$this->db->reset_cache();
		$this->opt_generated = false;
	}
	
	function search(){
		if( ! $this->opt_generated)
			return false;
		
		$r = $this->db->dbprefix('rooms');
		$u = $this->db->dbprefix('users');
		$raddr = $this->db->dbprefix('room_addresses');
		$rp = $this->db->dbprefix('room_photos');
		$rd = $this->db->dbprefix('room_descriptions');

		$select_sql = "
			SQL_CALC_FOUND_ROWS
			DISTINCT(`$r`.`id`),
			(SELECT `name` FROM `$rd` WHERE `$rd`.`room_id` = `$r`.`id` ORDER BY `$rd`.`language`='".CURRENT_LANGUAGE."' DESC LIMIT 1) AS name, 
			`user_id`,
			`username` AS user_name,
			`lat`, `lng`, 
			GROUP_CONCAT(DISTINCT `$rp`.`id` ORDER BY `order`) as picture_ids,
			`has_photo` AS `user_has_photo`, 
			`address`, 
			`price_native`, 
			`native_currency` 
		";
		
		$this->db->select($select_sql, false);
		$this->db->join('users', 'users.id = rooms.user_id', 'inner');
		$this->db->group_by('rooms.id');
		
		$query = $this->db->get();
		return $query->result();
	}

	function count_all(){
		if( ! $this->opt_generated)
			return false;

		$query = $this->db->query('SELECT FOUND_ROWS() as count_all');
		return $query->result();
	}
	
	function count_amenities(){
		if( ! $this->opt_generated)
			return false;

		$r = $this->db->dbprefix('rooms');
		$this->db->select("COUNT(`$r`.`id`) as `count`, `amenity_id`", false);
		$this->db->join('room_amenities', 'room_amenities.room_id = rooms.id','left');
		$this->db->group_by('amenity_id');
		$this->db->having('amenity_id >', 0);
		$query = $this->db->get();
		return $query->result();
	}
	
	function count_property_types(){
		if( ! $this->opt_generated)
			return false;
			
		$r = $this->db->dbprefix('rooms');
		$this->db->select("COUNT(`$r`.`id`) as `count`, `property_type_id`", false);
		$this->db->group_by('property_type_id');		
		$query = $this->db->get();
		return $query->result();
	}	
	
	function count_room_types(){
		if( ! $this->opt_generated)
			return false;
			
		$r = $this->db->dbprefix('rooms');
		$this->db->select("COUNT(`$r`.`id`) as `count`, `room_type`", false);
		$this->db->group_by('room_type');		
		$query = $this->db->get();
		return $query->result();	
	}	
}

// End of file search_model.php
// location: /application/models/
