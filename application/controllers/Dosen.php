<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dosen_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	
	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Dosen';

		if ($data['user']['level']=='admin') {
			$this->load->view('dosen/index',$data);
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
		$sql_total = $this->Dosen_model->count_all();
		$sql_data = $this->Dosen_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Dosen_model->count_filter($search);
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
		$data['title']='Tambah Data Dosen';
		$data['jurusan']=$this->db->get('db_jurusan')->result();

		if ($data['user']['level']=='admin') {
			$this->load->view('dosen/create',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function store()
	{
		$data = $this->input->post();

		$config['upload_path']          = './uploads/foto_dosen/';
		$config['file_name']            = 'dosen_'.date('YmdHis').'_'.uniqid();
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 1024;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$data['foto_dosen'] = 'foto_dosen/'.$this->upload->data("file_name");
			$this->db->insert('db_dosen', $data);
			$this->session->set_flashdata('message', 'Data berhasil di input !');
			redirect(site_url('dosen'));
		}else{
			$this->session->set_flashdata('error', $this->upload->display_errors());
			$this->session->set_flashdata('input', $data);
			redirect(site_url('dosen/create'));
		}
	}

	public function edit($id)
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Tambah Data Dosen';
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['agama'] = [
			'Islam',
			'Kristen',
			'Buddha',
			'Hindu',
		];
		$data['dosen']=$this->db->get_where('db_dosen',['id_mhs'=>$id])->row_array();

		$this->load->view('dosen/edit',$data);
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
