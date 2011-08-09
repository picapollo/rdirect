<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Search_model extends CI_Model {
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function search($opt){
		$r = $this->db->dbprefix('rooms');
		$u = $this->db->dbprefix('users');
		$ra = $this->db->dbprefix('room_addresses');
		$rp = $this->db->dbprefix('room_photos');
		$rd = $this->db->dbprefix('room_descriptions');
		
		$room_photo_only = false; 
		
		$sql  = "SELECT DISTINCT($r.id), user_id, username as user_name, lat, lng, GROUP_CONCAT(DISTINCT $rp.id ORDER BY `order`) as picture_ids, ";
		$sql .= "has_photo as user_has_photo, address, $rd.name as name, price_native, native_currency FROM $r "; 
		
		$sql .= "INNER JOIN $ra ON $ra.room_id = $r.id INNER JOIN $rd ON $rd.room_id = $r.id ";
		$sql .= "INNER JOIN $u ON $r.user_id = $u.id ";
		
		// 사진 있는 방만 검색시 $rp JOIN 형태ᅟᅳ를 INNER 로 바꿈 (WHERE 조건 추가 없이 속도향상)
		$sql .= ($room_photo_only ? 'INNER JOIN' : 'LEFT JOIN') . " $rp ON $rp.room_id = $r.id ";
		
		// Keep WHERE statement for count
		$this->where = $this->_generate_where($opt);
		
		$sql .= $this->where;
		
		$sql .= " GROUP BY $r.id ORDER BY $rd.language='".CURRENT_LANGUAGE."' DESC";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_res(){
		if( empty($this->where))
			return null;

		$r = $this->db->dbprefix('rooms');
		$u = $this->db->dbprefix('users');
		$ra = $this->db->dbprefix('room_addresses');
		$rp = $this->db->dbprefix('room_photos');
		$rd = $this->db->dbprefix('room_descriptions');
		
		$room_photo_only = false; 
		
		$sql = " SELECT COUNT(*) as count, amenities FROM $r ";
		
		$sql .= "INNER JOIN $ra ON $ra.room_id = $r.id INNER JOIN $rd ON $rd.room_id = $r.id ";
		$sql .= "INNER JOIN $u ON $r.user_id = $u.id ";
		
		// 사진 있는 방만 검색시 $rp JOIN 형태ᅟᅳ를 INNER 로 바꿈 (WHERE 조건 추가 없이 속도향상)
		$sql .= ($room_photo_only ? 'INNER JOIN' : 'LEFT JOIN') . " $rp ON $rp.room_id = $r.id ";	
		
		$sql .= $this->where;
		
		$sql .= " GROUP BY amenities HAVING count > 0 ";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function _generate_where($opt)
	{
		$where = array('WHERE active = 1');
		
		$where[] = "lat BETWEEN '{$opt['sw_lat']}' AND '{$opt['ne_lat']}'";
		
		// 지도검색 범위 너무 크면 경도값 범위 역전 현상 발생 -> 보정
		if($opt['sw_lng'] > $opt['ne_lng'])
			$where[] = "(lng < {$opt['sw_lng']} OR lng > {$opt['ne_lng']})";
		else
			$where[] = "lng BETWEEN '{$opt['sw_lng']}' AND '{$opt['ne_lng']}'";
		
		if( ! empty($opt['price_min'])) $where[] = ' price_native >= ' . $opt['price_min'];
		if( ! empty($opt['price_max']))	$where[] = ' price_native <= ' . $opt['price_max'];
		
		if( ! empty($opt['min_bedrooms'])) $where[] = ' bedrooms >= ' . $opt['min_bedrooms'];
		if( ! empty($opt['min_beds'])) $where[] = ' beds >= ' . $opt['min_beds'];
		if( ! empty($opt['guests'])) $where[] = ' guests_included >= ' . $opt['guests'];
		if( ! empty($opt['room_types'])) $where[] = ' room_type IN ("' . implode('","', $opt['toom_types']) . '")';
		if( ! empty($opt['hosting_amenities'])) $where[] = ' amenities & ' . implode(' & ', $opt['hosting_amenities']);
		
		// TODO
		if( ! empty($opt['checkin']) && ! empty($opt['checkout']))
		{
			;
		}
		
		return implode(' AND ', $where);
	}
}

// End of file search_model.php
// location: /application/models/
