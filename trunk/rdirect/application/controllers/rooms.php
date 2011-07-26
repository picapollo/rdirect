<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *	Rooms
 */
class Rooms extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('rooms_model');
	}
	
	/**
	 * Show list of rooms
	 */
	function index(){
		
	}

	/**
	 * Register new room
	 * route: /rooms/new
	 */
	function post_room()
	{
		$this->load->library('encrypt');
		$this->data['sig'] = hash('md5', $this->input->server('REMOTE_ADDR'));
		$this->load->view('rooms/post_room', $this->data);
	}
	
	function update()
	{
		$redirect_params = $this->input->post('redirect_params');
		$retry_params = $this->input->post('retry_params');
		$address = $this->input->post('address');
		$hosting = $this->input->post('hosting');
		
		$query_data = array();
		
		if(isset($redirect_params['new_hosting']) && $redirect_params['new_hosting'] == 1)
		{
			/**
			 * 	새로 만드는 경우
			 */
			$query_data['address_native'] = $address['formatted_address_native'];
			$query_data['address_apt'] = $address['apt'];
			$query_data['lat'] = $address['lat'];
			$query_data['lng'] = $address['lng'];
			
			$this->load->library('geocoder');
			$query_data['address'] = $this->geocoder->geocode_by_address($this->input->post('location_search'));
			
			/* 임시 데이터 생성 */
			$this->load->library('encrypt');
			$sig = hash('md5', $this->input->get('sig'));
			$data_tmp = array();
			$data_tmp['sig'] = $sig;
			$data_tmp['email'] = isset($hosting['email'])?$hosting['email']:'';
			if(isset($hosting['phone'])){
				$data_tmp['phone'] = $hosting['phone'];
				$data_tmp['phone_country'] = CURRENT_LANGUAGE;
			}
		
			$description = $hosting['description'];
			$directions = $hosting['directions'];
			unset($hosting['directions']);
			
			unset($hosting['phone']);
			unset($hosting['phone_country']);
			unset($hosting['email']);
			unset($hosting['description']);
			
			$query_data += $hosting;

			$rid = $this->rooms_model->create_room($query_data);
			$this->rooms_model->create_room_tmp($rid, $data_tmp);
			$this->rooms_model->add_description($rid, array(array('language'=>CURRENT_LANGUAGE, 'text'=>$description)) );
			if(isset($exact_address) && ! $exact_address)
			{
				$this->rooms_model->add_address_direction($rid, $directions);
			}
			$this->_handle_redirect('', array(
				'id'=>$rid, 
				'sig'=>$sig
			));
		}
		else
		{
			/**
			 * 	기존 방 업데이트
			 */
		
		}
	}
	
	function set_user($rid = null)
	{
		if( ! $rid || ! $this->input->get('new_hosting'))
		{
			//$this->_add_notice('no rid, no new_hosting');
			//redirect('');
		}
		
		$temp_info = $this->rooms_model->get_room_tmp($rid);
		$room_info = $this->rooms_model->get_room($rid);
		
		if( ! isset($temp_info[0]) || ! isset($room_info[0]))
		{
			$this->_add_notice('no room info'); 
			redirect('');
		}

		if($this->tank_auth->is_logged_in())
		{
			
			if( $this->input->get('sig') != $temp_info[0]->sig)
			{
				$this->_add_notice('signature validation failure' . $this->input->get('sig') . '//' . $temp_info[0]->sig);
				redirect('');
			}
			
			$res = $this->rooms_model->set_user($rid, $this->tank_auth->get_user_id());
			if( ! $res){
				$this->_add_notice('user assign failure');
				redirect('');
			}
			redirect('rooms/show/'.$rid);
		}
		else
		{
			$get_params = array(
				'email' => $temp_info[0]->email,
				'redirect_params[name]' => $room_info[0]->name,
				'redirect_params[sig]' => $this->input->get('sig'),
				'redirect_params[action]' => 'set_user',
				'redirect_params[new_hosting]' => 1,
				'redirect_params[id]' => $rid,
				'redirect_params[prompt]' => 'new_listing',
				'redirect_params[controller]' => 'rooms'
			);
			redirect('users/signup_login?'.http_build_query($get_params));
		}
	}

	/**
	 * Show room information
	 * route: /rooms/$id
	 * @param	int
	 */
	function show($rid = null)
	{
		if(!$rid) show_404();
		$res = $this->rooms_model->get_room($rid);
		if(!isset($res[0])) show_404();
		$this->data['room'] = $res[0];
		$this->load->view('rooms/show', $this->data);
	}

	/**
	 * Edit room information
	 * route: /rooms/$id/edit
	 * @param	int
	 * @get		section: photos, details
	 */
	function edit($rid = null)
	{
		echo 'edit : ' . $rid . '<br>';
		echo 'section: ' . $this -> input -> get('section');
	}

	/**
	 * Delete room
	 * @param	int
	 */
	function delete($rid = null)
	{

	}
	
	function sublet_available($rid = null)
	{
		
	}
	
	function similar_listings($rid = null)
	{
		$this->load->view('ajax/similar_listings');
	}
	
	function social_connections($rid = null)
	{
		
	}

	function this_hosting_reviews_first($rid = null)
	{
		
	}
	
	function other_hosting_reviews_first($rid = null)
	{
		
	}
	
	function lb_share($rid = null)
	{
		
	}
	
	function calendar_tab_inner2($rid = null)
	{
		
	}
	
	function ajax_lwlb_contact($rid = null)
	{
		
	}
	
	function ajax_refresh_subtotal($rid = null)
	{
		
	}
	
	function ajax_increment_impressions($rid = null)
	{
		
	}
}

/* End of file rooms.php */
