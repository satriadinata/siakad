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
		// if (!$session) {
		// 	redirect('auth');
		// }
		// echo "<pre>";
		// print_r($session);
		// echo "</pre>";
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
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$sql_total = $this->Matkul_model->count_all(); // Panggil fungsi count_all pada Matkul_model
		$sql_data = $this->Matkul_model->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada Matkul_model
		$sql_filter = $this->Matkul_model->count_filter($search); // Panggil fungsi count_filter pada Matkul_model
		$callback = array(
			'draw'=>$_POST['draw'], // Ini dari datatablenya
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}
	public function hapus($id)
	{
		$this->db->delete('db_makul',['id_mk'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('matkul'));
	}
	public function getEdit($id)
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
	public function tambah()
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
}
