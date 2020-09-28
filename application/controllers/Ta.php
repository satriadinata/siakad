<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ta extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ta_model');
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
		$data['title']="Tahun Ajar";
		if ($data['user']['level']=='admin') {
			$this->load->view('ta/index', $data);
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
		$sql_total = $this->Ta_model->count_all(); // Panggil fungsi count_all pada Ta_model
		$sql_data = $this->Ta_model->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada Ta_model
		$sql_filter = $this->Ta_model->count_filter($search); // Panggil fungsi count_filter pada Ta_model
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
		$this->db->delete('db_ta',['id_ta'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('ta'));
	}
	public function getEdit($id)
	{
		$data['ta']=$this->db->get_where('db_ta',['id_ta'=>$id])->row_array();
		$this->load->view('ta/edit',$data);
	}
	public function update()
	{
		$data=[
			'ta'=>$this->input->post('ta',true),
		];
		$this->db->where('id_ta',$this->input->post('id_ta',true));
		$this->db->update('db_ta', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('ta'));
	}
	public function tambah()
	{
		$data=[
			'ta'=>$this->input->post('ta',true),
		];
		$this->db->insert('db_ta', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('ta'));
	}
}
