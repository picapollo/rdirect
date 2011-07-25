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
		$this->load->view('rooms/post_room', $this->data);

	}
	
	function update()
	{
		foreach($_POST as $key => $value) {
			$value = $this->input->post($key);
			echo $key.' : ';
			print_r($value);
			echo '<br>';
		}
		
		$redirect_params = $this->input->post('redirect_params');
		$retry_params = $this->input->post('retry_params');
		$address = $this->input->post('address');
		$hosting = $this->input->post('hosting');
		
		
		if($redirect_params['new_hosting'])
		{
			
		}
	}
	
	function set_user($rid = null)
	{
		
	}

	/**
	 * Show room information
	 * route: /rooms/$id
	 * @param	int
	 */
	function show($rid = null)
	{
		echo 'show : ' . $rid . '<br>';
		echo $new_room = $this->input->get('new_hosting');
		
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
		
	}
	
	function social_connections($rid = null)
	{
		
	}

}

/* End of file rooms.php */
