<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	
	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']="Home";
		$data['jumlah_mhs']=$this->db->count_all_results('db_mahasiswa');
		$data['jmlh_dosen']=$this->db->count_all_results('db_dosen');
		$data['jmlh_makul']=$this->db->count_all_results('db_makul');
		$data['ta']=$this->db->get('db_ta')->result();
		if ($data['user']['level']=='admin') {
			$this->load->view('home', $data);
		}else{
			// echo 'Wellcome '.$data['user']['level'].' '.$data['user']['username'];
			$paketKrs=$this->db->get('db_paket_krs')->result();
			$krs=[];
			foreach ($paketKrs as $value) {
				$krs[$value->id_krs]=[
										'ta'=>$value->ta,
										'semester'=>$value->semester,
										'jurusan'=>$this->db->get_where('db_jurusan',['id_jur'=>$value->id_jurusan])
										];
			};
			echo "<pre>";
			print_r($krs);
			echo "</pre>";
		};
	}
}
