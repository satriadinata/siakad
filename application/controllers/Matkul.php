<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Matkul_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}

	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']="Mata Kuliah";
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		if ($data['user']['level']=='admin') {
			$this->load->view('matkul/index', $data);
		}else{
			echo $data['user']['level'];
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
		$sql_total = $this->Matkul_model->count_all();
		$sql_data = $this->Matkul_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Matkul_model->count_filter($search);
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
		$data=[
			'kode_mk'=>$this->input->post('kode_mk',true),
			'nama_mk'=>$this->input->post('nama_mk',true),
			'sks'=>$this->input->post('sks',true),
			'semester'=>$this->input->post('semester',true),
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
		];
		$this->db->insert('db_makul', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('matkul'));
	}

	public function edit($id)
	{
		$data['makul']=$this->db->get_where('db_makul',['id_mk'=>$id])->row_array();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$this->load->view('matkul/edit',$data);
	}

	public function update()
	{
		$data=[
			'kode_mk'=>$this->input->post('kode_mk',true),
			'nama_mk'=>$this->input->post('nama_mk',true),
			'sks'=>$this->input->post('sks',true),
			'semester'=>$this->input->post('semester',true),
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
		];
		$this->db->where('id_mk',$this->input->post('id_mk',true));
		$this->db->update('db_makul', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('matkul'));
	}

	public function delete($id)
	{
		$this->db->delete('db_makul',['id_mk'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('matkul'));
	}

}
