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
		if( ! $uid = $this->tank_auth->get_user_id())
			redirect ('');
		
		// 방이 하나라도 있어야
		if( $this->rooms_model->count_rooms_of_user($uid) )
		{	
			// 검색조건: 활성/비활성
			switch($this->input->get('f'))
			{
				case 'active':
					$activity = '1';
					$this->data['search_mode'] = 'active';
					break;
				case 'inactive':
					$activity = '0';
					$this->data['search_mode'] = 'inactive';
					break;
				default:
					$activity = null;
					$this->data['search_mode'] = 'none';
			}
			
			$this->data['rooms'] = $this->rooms_model->get_rooms_lite($uid, $activity);
			
			// 방 활성화\비활성화 위한 키 생성
			$this->load->library('encrypt');
			$this->data['sig'] = $this->encrypt->sha1($uid.$this->input->server('REMOTE_ADDR'));
		}
		else 	// 방이 하나도 없는 경우
		{
			$this->data['no_listing'] = TRUE;
		}
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
	
	function update($rid = null)
	{
		if( ! $rid)
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
				$this->load->library('geocoder');
				$address['address'] = $this->geocoder->geocode_by_address($this->input->post('location_search'));
				
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
			
				$description = array();
				$description[0] = array(
					'language' => CURRENT_LANGUAGE,
					'description' => $hosting['description'],
					'name' => $hosting['name']
				);
				
				unset($hosting['phone']);
				unset($hosting['phone_country']);
				unset($hosting['email']);
				unset($hosting['name']);
				unset($hosting['description']);
				
				// 집 좌표 직접 노출 방지 위한 인근지점 임의 좌표 생성 (근데 어차피 html소스보기하면 원래좌표 나오니 눈가리고 아웅)
				
				$address['lat_fuzzy'] = $address['lat'] + (mt_rand()/mt_getrandmax() - 0.5)*0.01;
				$address['lng_fuzzy'] = $address['lng'] + (mt_rand()/mt_getrandmax() - 0.5)*0.01;
				
				$rid = $this->rooms_model->create_room($hosting);
				$this->rooms_model->create_address($rid, $address);
				$this->rooms_model->create_room_tmp($rid, $data_tmp);
				$this->rooms_model->add_descriptions($rid, $description);

				$this->_handle_redirect('', array(
					'id'=>$rid, 
					'sig'=>$sig
				));
			}
			else
			{
				redirect('');
			}
		}
		else // From /rooms/$rid/edit/
		{
			if( ! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()))
				redirect('');
			
			$hosting = $this->input->post('hosting');
			$hosting_descriptions = $this->input->post('hosting_descriptions');
			$amenities = $this->input->post('amenities'); 
			$pets = $this->input->post('pets');
			
			if( ! empty($amenities)) $hosting['amenities'] = implode(',', $amenities);
			if( ! empty($pets)) $hosting['pets'] = implode(',', $pets);
			
			$this->rooms_model->update_room($rid, $hosting);
			
			$delete_lang = array();
			foreach($hosting_descriptions as $k => $i)
			{
				if($i['delete'] == 'true')
				{
					$delete_lang[] = $k;
					unset($hosting_descriptions[$k]);
				}
				else
				{
					if(empty($i['name']) || strlen($i['name']) > 35 || empty($i['description']))
					{
						unset($hosting_descriptions[$k]);
					}
				}
			}
			
			$this->rooms_model->update_descriptions($rid, $hosting_descriptions);
			$this->rooms_model->delete_descriptions($rid, $delete_lang);
						
			// TODO: AJAX 결과값 생성 
			$res = array();
			$res['available'] = true;
			$res['redirect_to'] = site_url('rooms/'.$rid);
			$res['result'] = 'success';
			$res['prompt'] = $this->db->last_query();
			
			// TODO: $res['result'] = 'error';
			
			
			echo json_encode($res);
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
		if(empty($res)) show_404();
		$this->data['room'] = $res[0];
		
		$this->data['is_owner'] = $this->tank_auth->get_user_id() == $res[0]->user_id;
		
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
		if( ! $rid || ! $this->tank_auth->is_logged_in() || ! $this->rooms_model->is_owner($rid, $this->tank_auth->get_user_id()))
			redirect('');
		
		// 방 정보 가져오기
		$res = $this->rooms_model->get_room($rid);
		if(empty($res)) show_404();
		$this->data['room'] = $res[0]; 
		
		// 방 활성화\비활성화 위한 키 생성
		$this->load->library('encrypt');
		$this->data['sig'] = $this->encrypt->sha1($this->tank_auth->get_user_id().$this->input->server('REMOTE_ADDR'));
		
		if($this->input->get('section') == 'photos')
		{
			$this->data['photos'] = $this->rooms_model->get_all_photos($rid);
			$this->load->view('rooms/edit_photos', $this->data);
		} 
		else
		{
			$descriptions = $this->rooms_model->get_all_descriptions($rid);
			$this->data['descriptions'] = ( ! $descriptions) ? array() : $descriptions; 
			$this->data['property_type_list'] = $this->rooms_model->get_property_type_list();
			$this->data['amenity_list'] = $this->rooms_model->get_amenity_list();
			$this->data['bed_type_list'] = $this->rooms_model->get_bed_type_list();
			$this->load->language('hosting/amenities');
			$this->load->view('rooms/edit_details', $this->data);
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
		$this->load->view('ajax/lwlb_contact');
	}
	
	function ajax_refresh_subtotal()
	{
		$rid = $this->input->get('hosting_id');
		$checkin = $this->input->get('checkin');
		$checkout = $this->input->get('checkout');
		$number_of_guets = $this->input->get('number_of_guests');
		
		$res = array();
		// TODO: if available
		$res['available'] = TRUE;
		$res['price_per_night']='$18';
		$res['can_instant_book']=FALSE;
		$res['service_fee']='$2';
		$res['nights']=1;
		// TODO: else
		$res['available'] = FALSE;
		$res['reason_message'] = 'Property turend off'; //TODO if turned off;
		
		$res['total_price'] = '$1243'; //TODO
		
		echo json_encode($res);
	}
	
	function ajax_check_dates($rid = null)
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
				'message' => 'An error occurred'
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
