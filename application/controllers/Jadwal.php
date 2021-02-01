<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Jadwal_model');
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
		$data['title']="Jadwal";
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		if ($data['user']['level']=='admin') {
			$this->load->view('jadwal/index', $data);
		}else{
			echo $data['user']['level'];
		};
	}

	public function getAll()
	{
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$jadwals = $this->Jadwal_model->get_jadwal();

		$data = array();

		foreach($jadwals->result() as $r) {

			$data[] = array(
				$r->ta,
				$r->kode_mk,
				$r->nama_mk,				
				$r->semester,				
				$r->nama_jurusan,
				$r->nama_dosen,
				$r->hari,
				$r->jam,
				$r->id_jadwal,
				$r->created_at,
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $jadwals->num_rows(),
			"recordsFiltered" => $jadwals->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function store()
	{
		$data=$this->input->post();
		$ta=$this->db->get_where('db_ta',['status'=>'active'])->row_array()['ta'];
		if ($ta!=null) {
			$this->session->set_flashdata('message', 'Data berhasil di input !');
			$data['ta']=$ta;
			$this->db->insert('db_jadwal', $data);
		}else{
			$this->session->set_flashdata('error', 'Pastikan ada TA aktif !');
		};
		redirect(site_url('jadwal'));
	}

	public function edit($id)
	{
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		$data['jadwal']=$this->db->get_where('db_jadwal',['id_jadwal'=>$id])->row_array();
		$this->load->view('jadwal/edit',$data);
	}

	public function update()
	{
		$post=$this->input->post();
		$data=[
			'kd_mk'=>$post['kd_mk'],
			'kd_dosen'=>$post['kd_dosen'],
			'ta'=>$this->db->get_where('db_ta',['status'=>'active'])->row_array()['ta'],
			'hari'=>$post['hari'],
			'jam'=>$post['jam'],
		];
		$this->db->where('id_jadwal',$this->input->post('id_jadwal',true));
		$this->db->update('db_jadwal', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('jadwal'));
	}

	public function delete($id)
	{
		$this->db->delete('db_jadwal',['id_jadwal'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('jadwal'));
	}

}
