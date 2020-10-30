<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}
	public function test()
	{
		$this->load->view('test');
	}

	public function index()
	{
		if ($this->session->userdata('user_logged')) {
			redirect(site_url('home'));
		};
		$this->load->view('auth/login');
	}
	
	public function login()
	{
		if ($this->input->post()) {
			if ($this->user_model->doLogin()) {
				redirect('home');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('auth'));
	}

	public function pdf(){

		$data = array(
			"dataku" => array(
				"nama" => "Petani Kode",
				"url" => "http://petanikode.com"
			)
		);

		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-petanikode.pdf";
		$this->pdf->load_view('pdf', $data);


	}
}
