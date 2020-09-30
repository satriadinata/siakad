<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mahasiswa_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	
	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Mahasiswa';
		if ($data['user']['level']=='admin') {
			$this->load->view('mahasiswa/index',$data);
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
		$sql_total = $this->Mahasiswa_model->count_all();
		$sql_data = $this->Mahasiswa_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Mahasiswa_model->count_filter($search);
		$callback = array(
			'draw'=>$_POST['draw'],
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback);

	}

	public function create()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Tambah Data Mahasiswa';
		if ($data['user']['level']=='admin') {
			$this->load->view('mahasiswa/create',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function store()
	{
		$data=[
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
			'nama_jurusan'=>$this->input->post('nama_jurusan',true),
			'ketua_jurusan'=>$this->input->post('ketua_jurusan',true),
		];
		$this->db->insert('db_mahasiswa', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('mahasiswa'));
	}

	public function edit($id)
	{
		$data['mahasiswa']=$this->db->get_where('db_mahasiswa',['id_jur'=>$id])->row_array();
		$this->load->view('mahasiswa/edit',$data);
	}

	public function update()
	{
		$data=[
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
			'nama_jurusan'=>$this->input->post('nama_jurusan',true),
			'ketua_jurusan'=>$this->input->post('ketua_jurusan',true),
		];
		$this->db->where('id_jur',$this->input->post('id_jur',true));
		$this->db->update('db_jurusan', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('jurusan'));
	}

	public function delete($id)
	{
		$this->db->delete('db_jurusan',['id_jur'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('jurusan'));
	}
}
