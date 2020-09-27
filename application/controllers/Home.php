<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
		// if (!$session) {
		// 	redirect('auth');
		// }
		// echo "<pre>";
		// print_r($session);
		// echo "</pre>";
	}
	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']="Home";
		if ($data['user']['level']=='admin') {
			$this->load->view('home', $data);
		};
	}
}
