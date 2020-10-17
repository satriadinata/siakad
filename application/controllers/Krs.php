<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Krs_model');
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
		$data['title']='KRS';
		$data['ta']=$this->db->get('db_ta')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		// $data['jadwal']=$this->db->get('db_jadwal')->result();
		$data['jadwal']=$this->Jadwal_model->getJadwal();
		if ($data['user']['level']=='admin') {
			$this->load->view('krs/index',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function getAll()
	{
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_index = $_POST['order'][0]['column'];
		$order_field = $_POST['columns'][$order_index]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$sql_total = $this->Krs_model->count_all();
		$sql_data = $this->Krs_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Krs_model->count_filter($search);
		$callback = array(
			'draw'=>$_POST['draw'],
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback);

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
				'kd_mk'=>$v[1],
				'kd_dosen'=>$v[2],
				'hari'=>$v[3],
				'jam'=>$v[4],
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
		$this->load->view('krs/detail',$data);
	}

	public function delete($id)
	{
		$this->db->delete('db_paket_krs',['id_krs'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('krs'));
	}
}
