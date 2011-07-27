<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pictures_model extends CI_Model {
	
	private $image_config;
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->image_config['image_library'] = 'gd2';
		$this->image_config['overwrite'] = TRUE;
		$this->image_config['allowed_types'] = 'jpg|jpeg|gif|png';
		$this->load->library('image_lib');
	}
	
	function create_user_images($user_id, $source_image){
		
		$new_path = UPLOADS_ROOT . '/users/' . $user_id;
		$this->_mkdir($new_path);
		
		if( ! $this->_resize($source_image, 'large.png', $new_path, 255, 255) || 
			! $this->_resize($source_image, 'medium.png', $new_path, 68, 68) ||
			! $this->_resize($source_image, 'small.png', $new_path, 50, 50) ||
			! $this->_resize($source_image, 'tiny.png', $new_path, 36, 36))	return FALSE;
		
		return TRUE;
	}
	
	function create_room_images($rid, $source_image){
		$rp = $this->db->dbprefix('room_photos');
		$query_str = "INSERT INTO rd_room_photos (`room_id`, `order`) "
					."SELECT $rid, IFNULL(MAX(`rp`.`order`)+1, 1) FROM $rp AS rp WHERE rp.room_id=$rid";
		$this->db->query(mysql_escape_string($query_str));		
		
		if( ! $pid = $this->db->insert_id())
			return FALSE;
		
		$new_path = UPLOADS_ROOT . '/rooms/' . $pid;
		$this->_mkdir($new_path);
		
		if( ! $this->_resize($source_image, 'large.jpg', $new_path, 639, 426, TRUE) || 
			! $this->_resize($source_image, 'mini_square.jpg', $new_path, 68, 68, TRUE) ||
			! $this->_resize($source_image, 'x_small.jpg', $new_path, 114, 74, TRUE) ||
			! $this->_resize($source_image, 'small.jpg', $new_path, 216, 144, TRUE))	return FALSE;
		
		return $pid;
	}
	
	function create_user_images_from_fb($user_id, $facebook_id){
		try{
			$save_to = './uploads/users/' . $facebook_id . '.jpg';
			
			$ch = curl_init('http://graph.facebook.com/'. $facebook_id . '/picture?type=large');
	        $fp = fopen($save_to, "wb");
	
	        // set URL and other appropriate options
	        $options = array(CURLOPT_FILE => $fp,
	                         CURLOPT_HEADER => 0,
	                         CURLOPT_FOLLOWLOCATION => 1,
	                         CURLOPT_TIMEOUT => 60); // 1 minute timeout (should be enough)
	
	        curl_setopt_array($ch, $options);
			//Get the result of the request and write it into the file
		    $res=curl_exec($ch);
		    curl_close($ch);
		    fwrite($fp,$res);
		    fclose($fp);
			$created = $this->create_user_images($user_id, $save_to);
			unlink($save_to);
			return $created;
		} catch (Exception $e) {
			error_log($e);
			return null;
		}
	}
	
	function _mkdir($path){
		if( ! is_dir($path))
		{
			$old_mask = umask(0); 
			mkdir($path, 0777);
			umask($old_mask);
		}		
	}
	
	function _resize($source_image, $new_image_name, $path,$width, $height, $maintain_ratio=FALSE)
	{
		$this->image_config['source_image'] = $source_image;
		$this->image_config['new_image'] = $path . '/' . $new_image_name;
		$this->image_config['width'] = $width;
		$this->image_config['height'] = $height;
		$this->image_config['maintain_ratio'] = $maintain_ratio;
		$this->image_lib->initialize($this->image_config);
		return $this->image_lib->resize();
	}
	
	function update_caption($pid, $text){
		$this->db->set('caption', $text);
		$this->db->where('id', $pid);
		$this->db->update('room_photos');
	}
}

// End of file pictures_model.php
// location: /application/models/
