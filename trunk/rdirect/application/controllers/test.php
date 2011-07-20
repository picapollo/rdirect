<?php 	if(!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *
 */
class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function index()
	{
		$this->load->library('facebook');

		print_r($cookie = $this->facebook->get_facebook_cookie());
		echo "<br><br>".$cookie['access_token'];
		echo "<br><br>".file_get_contents( 'https://graph.facebook.com/me?access_token=' .	$cookie['access_token']);
		$user = @json_decode(file_get_contents( 'https://graph.facebook.com/me?access_token=' .	$cookie['access_token']), true);
		
		$this->load->model('pictures_model');
		$this->pictures_model->create_user_images_from_fb('1', '100001741515267');
		
	/*	echo '<br><br>';
		echo CSS_ROOT . ' ' . JS_ROOT . ' ' . site_url('test/index');
		
		$this->load->view('header/page1');
		$this->load->view('top_menu');
		$this->load->view('footer'); */
	}

}

/* End of file test.php */
