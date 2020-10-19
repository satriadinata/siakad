<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends CI_Controller {

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

	public function get()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['makul']=$this->db->get('db_makul')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['jadwal']=$this->db->get('db_jadwal')->result();
		$data['pa']=$this->db->get('db_dosen')->result();
		$data['mhs']=$this->db->get_where('db_mahasiswa',['nim'=>$data['user']['username']])->row_array();
		$getIdJur=$this->db->get_where('db_jurusan',['kd_jurusan'=>$data['mhs']['kd_jurusan']])->row_array();
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['krs']=$this->db->get_where('db_paket_krs',['ta'=>$data['ta']['ta'], 'semester'=>$data['mhs']['semester'], 'id_jurusan'=>$getIdJur['id_jur']])->row_array();
		if ($data['krs']!=null) {
			// $data['items']=$this->db->get_where('db_item_krs',['id_krs'=>$data['krs']['id_krs']])->result();
			$data['nilai']=$this->db->get_where('db_nilai',['id_krs'=>$data['krs']['id_krs'], 'nim'=>$data['mhs']['nim']])->result();
		}else{
			// $data['items']=null;
			$data['nilai']=null;
		};
		$this->load->view('mhs/khs',$data);
	}
	public function simpan()
	{
		$post=$this->input->post();
		foreach ($post['store'] as $value) {
			$item=$this->db->get_where('db_item_krs',['id_item_krs'=>$value])->row_array();
			$krs=$this->db->get_where('db_paket_krs',['id_krs'=>$item['id_krs']])->row_array();
			$this->db->insert('db_nilai',[
				'id_krs'=>$item['id_krs'],
				'id_jadwal'=>$item['id_jadwal'],
				'ta'=>$krs['ta'],
				'nim'=>$post['nim'],
			]);
		};
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