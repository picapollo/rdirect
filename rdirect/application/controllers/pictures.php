<?php

/**
 * Airbnb에서 이쪽 uri로 접근하길래 일단 컨트롤러를 만들긴 했지만 CI에서는 낭비라는 생각을 지울 수 없음(Airbnb는 Ruby on Rails로 만듦)
 * 이왕 만들었으면 차라리 rooms와 users에서 사진 관련 기능을 전부 옮겨왔으면 하지만 시간이 없어서 나중으로 미룸 
 */
class Pictures extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('pictures_model');
	}
	
	function ajax_update_picture()
	{
		$rid = mysql_real_escape_string($this->input->post('hosting_id'));
		$pid = mysql_real_escape_string($this->input->post('picture_id'));
		if( $rid != $this->input->post('hosting_id') || $pid != $this->input->post('picture_id'))
			exit();
		
		$picture = $this->input->post('picture');
		
		$this->load->model('rooms_model');
		
		if( ! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()))
			echo '';
		
		if($this->input->post('commit') == 'Save')
		{
			$this->pictures_model->update_caption($pid, mysql_real_escape_string($picture['caption']));
		}
		
		$this->load->view('ajax/update_picture');
	}
}


// End of pictures.php