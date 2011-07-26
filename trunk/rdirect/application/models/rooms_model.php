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
			return  $this->db->insert_id();
		}
		return NULL;
	}
	
	function create_room_tmp($rid, $data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		$this->db->set('room_id', $rid);
		return $this->db->insert('room_temp', $data);
	}
	
	function set_user($rid, $uid){
		$this->db->set('user_id', $uid);
		$this->db->where('id', $rid);
		$this->db->update('rooms');
		return $this->db->affected_rows() > 0;
	}
	
	function activate_room($rid, $activated = 1){
		$this->db->set('activated', $activated);
		$this->db->where('id', $rid);
		$this->db->update('rooms');
		return $this->db->affected_rows() > 0;
	}
		
	function update_room($rid, $data)
	{
		/*foreach($data as $table)
		{
			foreach($table as $field)
			{
				$this->db->set
			}
		}*/
		
		/*
		
		$this->db->where('rooms.id', $rid);
		$this->db->where('rooms.id = rooms_detail.room_id');
		$this->db->update('rooms', $data);*/
	}

	function add_address_direction($rid, $direction){
		$this->db->set('room_id', $rid);
		$this->db->set('text', $direction);
		return $this->db->insert('room_directions');
	}
	
	function add_description($rid, $data)
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
	
	function star_room($uid, $rid, $star = TRUE){
		$this->db->where('user_id', $uid);
		$this->db->where('room_id', $rid);
		
		if($star)
		{
			$this->db->set('room_id', $rid);
			$this->db->insert('rooms_starred');
		}
		else
		{
			$this->db->where('room_id', $rid);
			$this->db->delete('rooms_starred');
		}
	}
	
	function get_room($rid)
	{
		$query = $this->db->get_where('rooms', array('id' => $rid));
		return $query->result();
	}
	
	function get_rooms_by_user($uid)
	{
		$query = $this->db->get_where('rooms', array('user_id' => $uid));
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
}

// End of file rooms_model.php
// location: /application/models/
