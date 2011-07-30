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
		//$this->image_config['master_dim'] = 'auto';
		$this->load->library('image_lib');
	}
	
	function create_user_images($user_id, $source_image){
		
		$new_path = './uploads/users/' . $user_id;
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
		
		$new_path = './uploads/rooms/' . $pid;
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
		if( $maintain_ratio )
		{
			$imageSize = $this->image_lib->get_image_properties($source_image, TRUE);
			$ratio = (($imageSize['height']/$imageSize['width']) - ($height/$width));
			$this->image_config['master_dim'] = ($ratio > 0) ? 'width' : 'height';			
		}
		
			
		$this->image_config['source_image'] = $source_image;
		$this->image_config['new_image'] = $path . '/' . $new_image_name;
		$this->image_config['width'] = $width;
		$this->image_config['height'] = $height;
		$this->image_config['maintain_ratio'] = $maintain_ratio;
		$this->image_lib->initialize($this->image_config);
		$res = $this->image_lib->resize();
		if( ! $maintain_ratio || ! $res)
			return $res;

		/*
		 * 이미지 크기가 정해진 비율 초과시 Crop
		 */
		$this->image_config['maintain_ratio'] = false;
		$this->image_config['source_image'] = $path.'/'.$new_image_name;
		$imageSize = $this->image_lib->get_image_properties($path.'/'.$new_image_name, TRUE);

		if($imageSize['width'] > $width)
			$this->image_config['x_axis'] = ($imageSize['width']-$width)/2;
		else if($imageSize['height'] > $height)
			$this->image_config['y_axis'] = ($imageSize['height']-$height)/2;
		else 	// 이미 비율이 맞으면 리턴
			return $res;		

		$this->image_lib->clear();
		$this->image_lib->initialize($this->image_config);
		return $this->image_lib->crop();
	}
	
	function update_caption($pid, $text){
		$this->db->set('caption', $text);
		$this->db->where('id', $pid);
		$this->db->update('room_photos');
	}
	
	function update_room_image_order($rid, $photos){
		if(empty($photos)) return null;
		$data = array();
		$order = 1;
		foreach($photos as $pid){
			$data[$pid] = $order++;
		}
		$rp = $this->db->dbprefix('room_photos');
		$ids = implode(',', array_keys($data));
		$sql = "UPDATE $rp SET `order` = CASE id ";
		foreach ($data as $id => $ordinal) {
		    $sql .= sprintf("WHEN %d THEN %d ", $id, $ordinal);
		}
		$sql .= "END WHERE id IN ($ids)";
		return $this->db->query($sql);
	}
	
	function delete_room_photo($rid, $pid)
	{
		$this->load->helper('file');
		delete_files(UPLOADS_PATH.'/rooms/'.$pid, TRUE);
		rmdir(UPLOADS_PATH.'/rooms/'.$pid);
		
		$this->db->delete('room_photos', array('id' => $pid));
		$rp = $this->db->dbprefix('room_photos');
		$sql = "UPDATE $rp SET `order`=1 WHERE room_id=$rid ORDER BY `order` ASC LIMIT 1";
		return $this->db->query($sql);
	}
}

// End of file pictures_model.php
// location: /application/models/
