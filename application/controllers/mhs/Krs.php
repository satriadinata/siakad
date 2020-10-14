<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Krs_model');
		$user = $this->session->userdata('user_logged');
		if ($user==null) {
			redirect(site_url('auth'));
		}elseif ($user['level']!='mhs') {
			$this->load->view('error/error_404');
		};
	}

	public function get($id)
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['ta']=$this->db->get('db_ta')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$mhs=$this->db->get_where('db_mahasiswa',['nim'=>$data['user']['username']])->row_array();
		$data['mhs']=$mhs;
		$data['krs']=$this->db->get_where('db_paket_krs',['id_ta'=>$id,'semester'=>$mhs['semester']])->row_array();
		if ($data['krs']!=null) {
			$data['item']=$this->db->get_where('db_nilai',['id_krs'=>$data['krs']['id_krs'],'nim'=>$mhs['nim']])->result();
		};
		$this->load->view('mhs/krs',$data);
	}
}
?>