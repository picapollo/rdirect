<?php

class Pictures extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('pictures_model');
	}
	
	function ajax_update_picture()
	{
		$rid = $this->input->post('hosting_id');
		$pid = $this->input->post('picture_id');
		$picture = $this->input->post('picture');
		
		$this->load->model('rooms_model');
		
		if( ! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()))
			echo '';
		
		if($this->input->post('commit') == 'Save')
		{
			$this->pictures_model->update_caption($pid, $picture['caption']);
		}
		
		echo "jQuery('#update_caption_submit_button').attr('value', 'Saved!').animate({ color: '#65b300' }, 'fast');" .
				"setTimeout(function(){ jQuery('#update_caption_submit_button').attr('value', 'Save')." .
				"animate({ color: '#000000' }, 'slow'); }, 2000)";
	}
}


// End of pictures.php