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
		if( ! $this->tank_auth->is_logged_in())
			redirect ('');
		
		// 검색조건: 활성/비활성
		switch($this->input->get('f'))
		{
			case 'active':
				$activity = '1';
				break;
			case 'inactive':
				$activity = '0';
				break;
			default:
				$activity = null;
		}
		
		$this->data['rooms'] = $this->rooms_model->get_rooms_lite($this->tank_auth->get_user_id(), $activity);
		
		// 방 활성화\비활성화 위한 키 생성
		$this->load->library('encrypt');
		$this->data['sig'] = $this->encrypt->sha1($this->tank_auth->get_user_id().$this->input->server('REMOTE_ADDR'));
		
		$this->load->view('rooms/rooms', $this->data);
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
		if( ! $rid || ! $this->tank_auth->is_logged_in() || ! is_owner($rid, $this->tank_auth->get_user_id()))
			redirect('');
		
		$this->data['room'] = $this->rooms_model->get_room($rid);
		if($this->input->get('section') == 'photos')
		{
			$this->data['photos'] = $this->rooms_model->get_all_photos($rid);
			$this->load->view('roos/edit_photos', $this->data);
		} 
		else
		{
			$this->load->view('roos/edit_photos', $this->data);
		}
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
	
	function ajax_hosting_image_upload()
	{
		$rid = $this->input->post('hosting_id');
		$new_photo = $this->input->post('new_photo');
	}
	
	function ajax_update_current_photo()
	{
		$rid = $this->input->get('hosting_id');
		$pid = $this->input->get('picture_id');
	}
	
	function ajax_update_image_order()
	{
		$rid = $this->input->get('hosting_id');
		print_r($this->input->post('sortable_photos'));
	}
	
	function change_availability($rid)
	{
		$is_available = $this->input->get('is_available');
		$redirect = ''.$this->input->get('redirect');
		$this->load->library('encrypt');
		if( ($is_available !== '1' && $is_available !== '0') ||
			$this->encrypt->sha1($this->tank_auth->get_user_id().$this->input->server('REMOTE_ADDR')) != $this->input->get('sig') ||
			! $this->rooms_model->change_availability($rid, $is_available))
		{ 
			$res = array(
				'result' => 'error',
				'message' => 'something is wrong'
			);
		}
		else
		{
			if($is_available)
			{
				$res = array(
					'result' => 'available',
					'message' => 'Your listing will now appear in public search result.'
				);
			}
			else
			{
				$res = array(
					'result' => 'unavailable',
					'message' => 'Your listing will be hidden from public search results.'
				);
			}	
		}
		echo json_encode($res);
	}
}

/* End of file rooms.php */
