<?php

class Favorites extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function star($rid)
	{
		if( ! $this->tank_auth->is_logged_in())
		{
			$res = array(
				'result' => 'login',
				'redirect_to' => site_url('signup_login')
			);
		}
		else
		{
			$method = $this->input->server('REQUEST_METHOD');
			
			$res = array(
				'is_star_group'=> true,
				"hosting_id" => $rid,
				"result" => "created"
			);

			switch($method)
			{
			case 'POST':
				$star = TRUE;
				$res["result"] = "created";
				break;
			case 'DELETE';
				$star = FALSE;
				$res["result"] = "deleted";
				break;
			default:
				echo '';
				return;
			}

			$this->load->model('rooms_model');
			$this->rooms_model->star_room($rid, $this->tank_auth->get_user_id(), $star);
		}
		echo json_encode($res);
	}
}// End of favorites.php