<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Krs_model');
		$this->load->model('Jadwal_model');
		$this->load->model('Khs_model');
		$user = $this->session->userdata('user_logged');
		if ($user==null) {
			redirect(site_url('auth'));
		}elseif ($user['level']!='admin') {
			$this->load->view('error/error_404');
		};
	}

	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='KHS';
		$ta=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['ta']=$this->db->get('db_ta')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		// $data['jadwal']=$this->db->get('db_jadwal')->result();
		$data['jadwal']=$this->Jadwal_model->getJadwal($ta['ta']);
		if ($data['user']['level']=='admin') {
			$this->load->view('khs/index',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function getAll()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$mhs = $this->Khs_model->get_mhs();

		$data = array();

		foreach($mhs->result() as $r) {

			$data[] = array(
				$r->nim,
				$r->nama_mhs,
				$r->nama_jurusan,
				$r->semester,
				"<button class='btn btn-success' data-toggle='modal' data-target='#modal-edit-jur' onclick='ehe($r->nim)'>Detail</button>"
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $mhs->num_rows(),
			"recordsFiltered" => $mhs->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function store()
	{
		$ta=$this->db->get_where('db_ta',['id_ta'=>$this->input->post('ta')])->row_array();
		$mhs=$this->db->get_where('db_mahasiswa',['semester'=>$this->input->post('semester')])->result();
		$data=[
			'id_ta'=>$this->input->post('ta'),
			'ta'=>$ta['ta'],
			'semester'=>$this->input->post('semester'),
			'id_jurusan'=>$this->input->post('id_jur'),
			'id_pa'=>$this->input->post('pa'),
		];
		$this->db->insert('db_paket_krs', $data);
		$insert_id=$this->db->insert_id();
		$item=$this->input->post('krs');
		foreach ($item as $value) {
			$v=explode('|',$value);
			$itemInput=[
				'id_krs'=>$insert_id,
				'id_jadwal'=>$v[0],
			];
			$this->db->insert('db_item_krs', $itemInput);
		};
	}

	public function detail($id)
	{
		$data['krs']=$this->db->get_where('db_paket_krs',['id_krs'=>$id])->row_array();
		$data['item']=$this->db->get_where('db_item_krs',['id_krs'=>$id])->result();
		$data['jurusan']=$this->db->get_where('db_jurusan',['id_jur'=>$data['krs']['id_jurusan']])->row_array();
		$data['pa']=$this->db->get_where('db_dosen',['id_dosen'=>$data['krs']['id_pa']])->row_array();
		$data['makul']=$this->db->get('db_makul')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();	
		$data['jadwal']=$this->db->get('db_jadwal')->result();	
		$this->load->view('krs/detail',$data);
	}

	public function delete($id)
	{
		$this->db->delete('db_paket_krs',['id_krs'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('krs'));
	}
	public function lock()
	{
		$data=[
			'status'=>'lock',
		];
		$this->db->where('id_krs',$this->input->post('id'));
		$this->db->update('db_paket_krs', $data);
	}
	public function unlock()
	{
		$data=[
			'status'=>'unlock',
		];
		$this->db->where('id_krs',$this->input->post('id'));
		$this->db->update('db_paket_krs', $data);	
	}
}
