<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *	Rooms
 */
class Rooms extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}
	
	/**
	 * Show list of rooms
	 */
	public function index(){
		
	}

	/**
	 * Register new room
	 * route: /rooms/new
	 */
	public function new_room()
	{

	}

	/**
	 * Show room information
	 * route: /rooms/$id
	 * @param	int
	 */
	public function show($id =0)
	{
		echo 'show : ' . $id;
	}

	/**
	 * Edit room information
	 * route: /rooms/$id/edit
	 * @param	int
	 * @get		section: photos, details
	 */
	public function edit($id =0)
	{
		echo 'edit : ' . $id . '<br>';
		echo 'section: ' . $this -> input -> get('section');
	}

	/**
	 * Delete room
	 * @param	int
	 */
	public function delete($id =0)
	{

	}

}

/* End of file rooms.php */
