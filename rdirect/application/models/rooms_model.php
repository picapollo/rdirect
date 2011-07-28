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
	
	/*
	 * 	여러 description 한번에 입력
	 */
	function add_descriptions($rid, $data)
	{
		foreach($data as $k => $row){
			$data[$k]['room_id'] = $rid;
		}
		return $this->db->insert_batch('room_descriptions', $data);
	}
	
	function update_description($rid, $data)
	{
		$this->db->where('room_id', $rid);
		return $this->db->update_batch('room_descriptions', $data);	
	}
	
	function delete_description($rid, $lang)
	{
		$this->db->where('room_id', $rid);
		$this->db->where('language', $lang);
		$this->db->delete('room_descriptions');
	}
	
	function star_room($rid, $uid, $star = TRUE){
		$rs = $this->db->dbprefix('rooms_starred');
		
		if($star)
		{
			$query_str = "INSERT IGNORE INTO `$rs` (user_id, room_id) VALUES ($uid, $rid)";
		}
		else
		{
			$query_str = "DELETE IGNORE FROM `$rs` WHERE user_id=$uid AND room_id=$rid";
		}

		return $this->db->query(mysql_real_escape_string($query_str));
	}
	
	function change_availability($rid, $status)
	{
		$query_str = $this->db->update_string('rooms', array('active'=>$status), array('id'=>$rid));
		$query_str = str_replace('UPDATE', 'UPDATE IGNORE', $query_str);
		return $this->db->query($query_str);
	}

	function get_descriptions($rid)
	{
		$this->db->select('name, description');
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
		$ra = $this->db->dbprefix('room_addresses');
		$rd = $this->db->dbprefix('room_descriptions');
		$pr = $this->db->dbprefix('room_property_types');
		
		$query_str  = "SELECT r.*, pr.name as property_type, ra.*, "
		. "(SELECT name FROM $rd ORDER BY `language`='".CURRENT_LANGUAGE."' DESC, `language`='en' DESC LIMIT 0, 1) as name " 
		. "FROM $r r INNER JOIN $ra ra ON r.id=ra.room_id INNER JOIN $pr pr ON r.property_type_id=pr.id WHERE r.id=$rid";
	
		$query = $this->db->query($query_str);
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
		$ra = $this->db->dbprefix('room_addresses');
		$uid = mysql_real_escape_string($uid);
		
		$query_str = "SELECT r.id, lat, lng, active, (SELECT rp.id FROM $rp as rp WHERE r.id = rp.room_id AND `rp`.`order`=1) as photo_id, ";
		$query_str .= "(SELECT name FROM $rd ORDER BY `language`='".CURRENT_LANGUAGE."' DESC, `language`='en' DESC LIMIT 0, 1) as name ";
		$query_str .= "FROM $r as r INNER JOIN $ra ra ON r.id=ra.room_id WHERE r.user_id=$uid ";
		if($activity !== null) $query_str .= "AND r.active = $activity"; 
		
		$query = $this->db->query($query_str);

		return $query->result();
	}
	
	function get_all_photos($rid)
	{
		$this->db->select('id, order');
		$this->db->where('room_id', $rid);
		$query = $this->db->get('room_photos');
		return $query->result();
	}
	
	function get_room_tmp($rid)
	{
		$query = $this->db->get_where('room_temp', array('room_id' => $rid));
		return $query->result();
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
		$this->db->select('user_id');
		$this->db->where('id', $rid);
		$this->db->get('rooms');
		return $uid == $rid;
	}
	
	function count_rooms_of_user($uid)
	{
		$this->db->where('user_id', $uid);
		return $this->db->count_all_results('rooms');
	}
	
	function choose_language($arr, $lang=CURRENT_LANGUAGE)
	{
		
	}
}

// End of file rooms_model.php
// location: /application/models/
