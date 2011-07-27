<?php

class Users_model extends CI_Model 
{
	// get user by their social media id
	function get_user_by_sm($data, $sm_id)
	{
		$this->db->select("u.*, up." . $sm_id);
		$this->db->from("users AS u");
		$this->db->join("user_profiles AS up", "u.id=up.user_id");
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();
	}

	// Returns user by its email
	function get_user_by_email($email)
	{
		$this->db->select("*");
		$this->db->from("users AS u");
		$this->db->join("user_profiles AS up", "u.id=up.user_id");
		$this->db->where(array('u.email' => $email));
		$query = $this->db->get();
		//$query = $this->db->query("SELECT * FROM rd_users u, rd_user_profiles up WHERE u.email='$email' and u.id = up.user_id");
		return $query->result();
	}
	
	// a generic update method for user profile
	function update_user_profile($user_id, $data)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('user_profiles', $data); 
	}
	
	function set_user_has_photo($user_id, $value = 1)
	{
		$this->db->update('users', array('users.has_photo' => $value));
	}

	// return the user given the id
	function get_user($user_id)
	{
		$this->db->select('*');
		$this->db->from("users AS u");
		$this->db->join("user_profiles AS up", "u.id=up.user_id");
		$this->db->where(array('u.id' => $user_id, 'up.user_id' => $user_id));
		$res = $this->db->get()->result();		
		if(empty($res)) return null;
		$res[0]->picture_path = $res[0]->has_photo ? UPLOADS_DIR.'/users/'.$user_id : IMG_DIR.'/default_profile'; 
		return $res[0];
	}
	
	function set_user_locale($user_id, $lang){
		$this->db->where('users.id', $user_id);
		$this->db->update('users', array('users.locale' => $lang));
	}
	
	function get_user_locale($user_id){
		$this->db->select('locale');
		$this->db->from('users AS u');
		$this->db->where('id', $user_id);
		$query = $this->db->get()->result();
		if(empty($res)) return null;
		return $res[0];
	}
	
	function get_starred_rooms($user_id){
		if(!$user_id) return null;
		$this->db->select('room_id');
		$this->db->where('user_id', $user_id);
		$this->db->from('rooms_starred');
		$query = $this->db->get();
		return $query->result();
	}
	
	function count_starred_rooms($user_id){
		if(!$user_id) return null;
		$this->db->where('user_id', $user_id);
		$this->db->from('rooms_starred');
		return $this->db->count_all_results();
	}
}
?>