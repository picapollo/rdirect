<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Calendar_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_tiles_full($rid, $start, $end){
		$this->db->select('id, status AS st, available AS isa, price AS daily_price, ');
		$this->db->where('room_id', $rid);
		$this->db->where("date BETWEEN $start AND $end");
		$this->db->group_by('room_id');
		$this->db->order_by('date');
		$this->db->get('calendar_dates');
	}
}

// End of calendar_model.php
// Location: application/models
