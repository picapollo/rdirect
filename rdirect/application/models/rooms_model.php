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
			$room_id = $this->db->insert_id();
			//if ($activated)	$this->create_profile($user_id);
			return array('room_id' => $user_id);
		}
		return NULL;
	}
	
	function activate_room($rid, $activated = 1){
		$this->db->set('activated', $activated);
		$this->db->where('id', $rid);
		$this->db->update('rooms');
	}
		
	function update_room($rid, $data)
	{
		$this->db->where('rooms.id', 1);
		$this->db->where('rooms.id = rooms_detail.room_id');
		$this->db->where('rooms.id = rooms_detail.room_id');
	}
	
	function update_room_profile($rid, $data)
	{
		
	}
	
	function update_room($rid, $data)
	{
		
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
