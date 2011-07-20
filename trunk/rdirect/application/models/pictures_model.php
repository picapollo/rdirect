<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pictures_model extends CI_Model {
	
	private $image_config;
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->image_config['image_library'] = 'gd2';
		$this->image_config['maintain_ratio'] = FALSE;
		$this->image_config['overwrite'] = TRUE;
		$this->load->library('image_lib', $this->image_config);
	}
	
	function create_user_images($user_id, $source_image){
		$new_path = UPLOADS_ROOT . '/users/' . $user_id;
		$this->_mkdir($new_path);
		
		if( ! $this->_resize($source_image, 'square_255.jpg', $new_path, 255, 255) || 
			! $this->_resize($source_image, 'medium.jpg', $new_path, 68, 68) ||
			! $this->_resize($source_image, 'small.jpg', $new_path, 50, 50) )	return FALSE;
		
		return TRUE;
	}
	
	function create_user_images_from_fb($user_id, $facebook_id){
		$image_path = UPLOADS_ROOT . '/users/' . $facebook_id . '.jpg';
		if( ! copy('http://graph.facebook.com/'. $facebook_id . '/picture?type=large', $image_path))
			return FALSE;
		return $this->create_user_images($user_id, $image_path);
		unlink($image_path);
	}
	
	function _mkdir($path){
		if( ! is_dir($path))
		{
			$old_mask = umask(0); 
			mkdir($path, 0777);
			umask($old_mask);
		}		
	}
	
	function _resize($source_image, $new_image_name, $path,$width, $height)
	{
		$this->image_config['source_image'] = $source_image;
		$this->image_config['new_image'] = $path . '/' . $new_image_name;
		$this->image_config['width'] = $width;
		$this->image_config['height'] = $height;
		$this->image_lib->initialize($this->image_config);
		return $this->image_lib->resize();
	}
	
}

// End of file pictures_model.php
// location: /application/models/
