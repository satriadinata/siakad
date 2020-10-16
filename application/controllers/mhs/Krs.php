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
		$data['makul']=$this->db->get('db_makul')->result();
		$mhs=$this->db->get_where('db_mahasiswa',['nim'=>$data['user']['username']])->row_array();
		$mhsIdJur=$this->db->get_where('db_jurusan',['kd_jurusan'=>$mhs['kd_jurusan']])->row_array();
		$data['mhs']=$mhs;
		$data['krs']=$this->db->get_where('db_paket_krs',['id_ta'=>$id,'semester'=>$mhs['semester'],'id_jurusan'=>$mhsIdJur['id_jur']])->row_array();
		$data['pa']=$this->db->get_where('db_dosen',['id_dosen'=>$data['krs']['id_pa']])->row_array();
		if ($data['krs']!=null) {
			$data['item']=$this->db->get_where('db_item_krs',['id_krs'=>$data['krs']['id_krs']])->result();
			$data['nilai']=$this->db->get_where('db_nilai',['id_krs'=>$data['krs']['id_krs'],'nim'=>$mhs['nim']])->result();
		};
		$this->load->view('mhs/krs',$data);
	}
	public function simpan()
	{
		$post=$this->input->post();
		foreach ($post['store'] as $value) {
			$item=$this->db->get_where('db_item_krs',['id_item_krs'=>$value])->row_array();
			$krs=$this->db->get_where('db_paket_krs',['id_krs'=>$item['id_krs']])->row_array();
			$kode_dosen=$this->db->get_where('db_dosen',['id_dosen'=>$item['id_dosen']])->row_array();
			$this->db->insert('db_nilai',[
				'id_krs'=>$item['id_krs'],
				'ta'=>$krs['ta'],
				'nim'=>$post['nim'],
				'kd_mk'=>$item['kode_mk'],
				'kd_dosen'=>$kode_dosen['kd_dosen'],
			]);
		};
		// print_r($post);
	}
	public function batal()
	{
		$post=$this->input->post();
		foreach ($post['store'] as $value) {
			$this->db->delete('db_nilai',['id_nilai'=>$value]);
		};
	}
}
?>