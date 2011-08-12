<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Rooms_model extends CI_Model {
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function create_room($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		if ($this->db->insert('rooms', $data)) {
			$rid = $this->db->insert_id();
			return $rid;
		}
		return NULL;
	}
	
	function create_address($rid, $data)
	{
		$this->db->set('room_id', $rid);
		return $this->db->insert('rd_room_addresses', $data);
	}
	
	function create_room_tmp($rid, $data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		$this->db->set('room_id', $rid);
		return $this->db->insert('room_temp', $data);
	}
	
	function update_room($rid, $data)
	{
		$this->db->update('rooms', $data, array('id'=>$rid));
	}
	
	function set_user($rid, $uid){
		$this->db->set('user_id', $uid);
		$this->db->where('id', $rid);
		$this->db->update('rooms');
		return $this->db->affected_rows() > 0;
	}
	
	function activate_room($rid, $activated = 1){
		$this->db->set('active', $activated);
		$this->db->where('id', $rid);
		$this->db->update('rooms');
		return $this->db->affected_rows() > 0;
	}

	function add_address_direction($rid, $direction){
		$this->db->set('room_id', $rid);
		$this->db->set('text', $direction);
		return $this->db->insert('room_directions');
	}
	
	function update_amenities($rid, $data)
	{
		$ramen = $this->db->dbprefix('room_amenities');
		
		$sql = "INSERT $ramen (room_id, amenity_id) VALUES ";
		foreach($data as $k => $i){
			$sql .= "($rid, $i),";
		}
		$sql = rtrim($sql, ',') . " ON DUPLICATE KEY UPDATE amenity_id=VALUES(amenity_id)"; 
		return $this->db->query($sql);
	}
	
	/*
	 * 	여러 description 한번에 입력
	 */
	function add_descriptions($rid, $data)
	{
		foreach($data as $k => $row){
			$data[$k]['room_id'] = $rid;
		}
		return $this->db->insert_batch('room_descriptions', $data);
		$sql = rtrim($sql, ',') . " ON DUPLICATE KEY UPDATE name=VALUES(name), description=VALUES(description)"; 
	}

	/**
	 * Update descriptions
	 * @param int 	room_id
	 * @param array $data[language][name, description]
	 */	
	function update_descriptions($rid, $data)
	{
		$rd = $this->db->dbprefix('room_descriptions');
		$sql = "INSERT $rd (room_id, language, name, description) VALUES ";
		foreach($data as $k => $i){
			$k = mysql_real_escape_string($k);
			$i['name'] = mysql_real_escape_string($i['name']);
			$i['description'] = mysql_real_escape_string($i['description']);
			$sql .= "($rid, '$k', '{$i['name']}', '{$i['description']}'),";
		}
		$sql = rtrim($sql, ',') . " ON DUPLICATE KEY UPDATE name=VALUES(name), description=VALUES(description)"; 
		return $this->db->query($sql);
	}
	
	/**
	 * Delete descriptions 
	 * @param int	room_id
	 * @param array languages
	 */
	function delete_descriptions($rid, $languages)
	{	
		$this->db->where('room_id', $rid);
		$this->db->where_in('language', $languages);
		return $this->db->delete('room_descriptions');
	}
	
	function star_room($rid, $uid, $star = TRUE){
		$rs = $this->db->dbprefix('rooms_starred');
		
		if($star)
		{
			$sql = "INSERT INTO `$rs` (user_id, room_id) VALUES ($uid, $rid) ON DUPLICATE KEY IGNORE";
		}
		else
		{
			$sql = "DELETE IGNORE FROM `$rs` WHERE user_id=$uid AND room_id=$rid";
		}

		return $this->db->query(mysql_real_escape_string($sql));
	}
	
	function change_availability($rid, $status)
	{
		$sql = $this->db->update_string('rooms', array('active'=>$status), array('id'=>$rid));
		$sql = str_replace('UPDATE', 'UPDATE IGNORE', $sql);
		return $this->db->query($sql);
	}

	function get_description($rid, $lang=CURRENT_LANGUAGE)
	{
		$this->db->select('name, description');
		$this->db->where(array('room_id' => $rid, 'language' => $lang));
		$query = $this->db->get('room_descriptions');
		return $query->result();
	}


	function get_all_descriptions($rid)
	{
		$this->db->select('language, name, description');
		$this->db->where('room_id', $rid);
		$query = $this->db->get('room_descriptions');
		return $query->result();
	}
	
	function get_address_all($rid)
	{
		$this->db->get_where('room_addresses', array('room_id', $rid));
	}
	
	function get_room($rid)
	{
		$r = $this->db->dbprefix('rooms');
		$raddr = $this->db->dbprefix('room_addresses');
		$rd = $this->db->dbprefix('room_descriptions');
		$rp = $this->db->dbprefix('room_photos');
		
		$sql  = "SELECT r.*, ra.*, rd.name, rd.description, rp.id as photo_id FROM $r r " 
		. " INNER JOIN $raddr ra ON r.id=ra.room_id "
		. " INNER JOIN $rd rd ON r.id=rd.room_id "
		. " LEFT JOIN $rp rp ON r.id=rp.room_id AND rp.`order`=1 "
		. " WHERE r.id=$rid ORDER BY rd.language='".CURRENT_LANGUAGE."' DESC LIMIT 1 ";
	
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_room_prices($rid)
	{
		$this->db->select('
			active, person_capacity, native_currency, price_native, weekly_price_native, monthly_price_native,
			price_for_extra_person_native, guests_included, extras_price_native, min_nights, max_nights
		');
		$query = $this->db->get_where('rooms', array('id' => $rid));
		return $query->result();
	}
	
	function get_room_full($rid)
	{
		$r = $this->db->dbprefix('rooms');
		$raddr = $this->db->dbprefix('room_addresses');
		$rd = $this->db->dbprefix('room_descriptions');
		$rp = $this->db->dbprefix('room_photos');
		$ramen = $this->db->dbprefix('room_amenities');
		
		$sql  = "SELECT r.*, raddr.*, rd.name, rd.description, rd.language, "
		. " GROUP_CONCAT(DISTINCT rp.id, '\"\"', IFNULL(rp.caption, '') ORDER BY rp.`order`) as photos, "
		. " GROUP_CONCAT(DISTINCT amenity_id) as amenities FROM $r r "
		. " INNER JOIN $raddr raddr ON r.id=raddr.room_id "
		. " INNER JOIN $rd rd ON r.id=rd.room_id "
		. " LEFT JOIN $ramen ramen ON r.id = ramen.room_id "
		. " LEFT JOIN $rp rp ON r.id=rp.room_id "
		. " WHERE r.id=$rid ORDER BY rd.language='".CURRENT_LANGUAGE."' DESC LIMIT 1 ";
	
		$query = $this->db->query($sql);
		return $query->result();		
	}
	
	function get_rooms($uid)
	{
		$query = $this->db->get_where('rooms', array('user_id' => $uid));
		return $query->result();
	}

	function get_rooms_lite($uid, $activity=null)
	{
		$r = $this->db->dbprefix('rooms');
		$rp = $this->db->dbprefix('room_photos');
		$rd = $this->db->dbprefix('room_descriptions');
		$raddr = $this->db->dbprefix('room_addresses');
		$uid = mysql_real_escape_string($uid);
		
		$sql = "SELECT r.id, lat, lng, active, (SELECT rp.id FROM $rp as rp WHERE r.id = rp.room_id AND `rp`.`order`=1) as photo_id, ";
		$sql .= "(SELECT name FROM $rd ORDER BY `language`='".CURRENT_LANGUAGE."' DESC, `language`='en' DESC LIMIT 0, 1) as name ";
		$sql .= "FROM $r as r INNER JOIN $raddr ra ON r.id=ra.room_id WHERE r.user_id=$uid ";
		if($activity !== null) $sql .= "AND r.active = $activity"; 
		
		$query = $this->db->query($sql);

		return $query->result();
	}
	
	function get_daily_price($rid)
	{
		$this->db->select('price_native, native_currency');
		$this->db->from('rooms');
		$this->db->where('id', $rid);
		$query = $this->db->get();
		return $query->result();
	}

	function get_currency($rid)
	{
		$this->db->select('native_currency');
		$this->db->from('rooms');
		$this->db->where('id', $rid);
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	 * Do not use! 이 기능은 pictures_model->add_room_photo에서 구현함
	 */
	function add_photo($rid, $pid)
	{
		return null; 
	}
	
	/**
	 * 나중에 pictures_model로 옮겨서 사진관련 기능은 통합하는 편히 바람직해 보임
	 */
	function get_all_photos($rid)
	{
		$this->db->select('`id`, `order`', false);
		$this->db->where('room_id', $rid);
		$this->db->order_by('`order`', 'ASC', false);
		$query = $this->db->get('room_photos');
		return $query->result();
	}
	
	function get_photo_by_id($pid)
	{
		$this->db->where('id', $pid);
		$query = $this->db->get('room_photos');
		return $query->result();
	}
	
	function get_photo_by_room($rid)
	{
		$this->db->select('id');
		$this->db->from('room_photos');
		$this->db->where(array('room_id'=> $rid, '`order`'=>1));
		$res = $this->db->get()->result();
		return empty($res) ? null : $res[0]->id;
	}
	
	function get_room_tmp($rid)
	{
		$query = $this->db->get_where('room_temp', array('room_id' => $rid));
		return $query->result();
	}
	
	function delete_temp_info($rid)
	{
		return $this->db->delete('room_temp', array('room_id' => $rid));
	}
	
	function search_nearby_rooms($rid, $dist_limit = 3956, $rows_limit = 10)
	{
		$this->db->select("destination.*, $dist_limit * 2 * ASIN(
		        SQRT(
		            POWER(SIN((orig.lat - dest.lat) * pi()/180 /2), 2) +
		            COS(orig.lat * pi()/180) *
		            COS(dest.lat * pi()/180) *
		            POWER(SIN((orig.lon - dest.lon) * pi/180 / 2), 2)
		        ))
		    as distance");
		$this->db->from('rooms dest, rooms orig');
		$this->db->where('orig.id = '.$rid.' AND
		    dest.lon between (orig.lon - dist / abs(cos(radians(orig.lon)) * 69)) and (orig.lon + dist / abs(cos(radians(orig.lon)) * 69)) AND
		    dest.lat between (orig.lat - (dist/69)) and (orig.lat + (dist/69))', NULL, FALSE);
		$this->db->limit($rows_limit);
		$query = $this->db->get(); 
		return $query->result();
	}
	
	function is_owner($rid, $uid)
	{
		$this->db->select('id');
		$this->db->where(array('id'=>$rid, 'user_id'=>$uid));
		$query = $this->db->get('rooms');
		return $query->num_rows() > 0;
	}
	
	function count_rooms_of_user($uid)
	{
		$this->db->where('user_id', $uid);
		return $this->db->count_all_results('rooms');
	}
	
	function choose_language($arr, $lang=CURRENT_LANGUAGE)
	{
		
	}
	
	function get_property_type_list($by_array = false)
	{
		return json_decode(file_get_contents('./include/static/property_types.json'), $by_array);
	}
	
	function get_amenity_list($by_array = false)
	{
		return json_decode(file_get_contents('./include/static/amenities.json'), $by_array);
	}
	
	function get_bed_type_list($by_array = false)
	{
		return json_decode(file_get_contents('./include/static/bed_types.json'), $by_array);
	}

	function is_active($rid)
	{
		$res = $this->db->select('active')->get_where('rooms', array('id', $rid))->result();
		if( ! $res || ! $res[0]->active)
			return false;
		return true;
	}
}

// End of file rooms_model.php
// location: /application/models/
