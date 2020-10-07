<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurusan_model');
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
		$data['title']='Jurusan';
		if ($data['user']['level']=='admin') {
			$this->load->view('jurusan/index',$data);
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
		$sql_total = $this->Jurusan_model->count_all();
		$sql_data = $this->Jurusan_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Jurusan_model->count_filter($search);
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
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
			'nama_jurusan'=>$this->input->post('nama_jurusan',true),
			'ketua_jurusan'=>$this->input->post('ketua_jurusan',true),
		];
		$this->db->insert('db_jurusan', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('jurusan'));
	}

	public function edit($id)
	{
		$data['jurusan']=$this->db->get_where('db_jurusan',['id_jur'=>$id])->row_array();
		$this->load->view('jurusan/edit',$data);
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
