<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Calendar_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_tiles_full($rid, $start, $end){
		$this->db->select('date, id, available AS isa, price AS daily_price ');
		$this->db->where('room_id', $rid);
		$this->db->where("date BETWEEN '$start' AND '$end'");
		//$this->db->group_by('room_id');
		$this->db->group_by('date');
		$query = $this->db->get('calendar_daily');
		return $query->result();
	}
	
	function update_dates($rid, $dates, $available=1, $price=0)
	{
		if( ! $price) $price = 0;
		$cd = $this->db->dbprefix('calendar_daily');
		$sql = "REPLACE $cd(room_id, `date`, available, price) VALUES ";
		foreach($dates as $date)
			$sql .= "($rid, '$date', $available, $price),";
		$sql = substr($sql, 0, -1);
		return $this->db->query($sql);
	}
}

// End of calendar_model.php
// Location: application/models
