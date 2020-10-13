<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ta_model');
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
		$data['title']="Semester";
		if ($data['user']['level']=='admin') {
			$this->load->view('semester/index', $data);
		}else{
			echo $data['user']['level'];
		};
	}

	public function update()
	{
		$data=$this->input->post();
		return print_r($data);
	}

	public function getAll()
	{
		$search = $_POST['search']['value'];
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order_index = $_POST['order'][0]['column'];
		$order_field = $_POST['columns'][$order_index]['data'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$sql_total = $this->Ta_model->count_all();
		$sql_data = $this->Ta_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Ta_model->count_filter($search);
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
			'ta'=>$this->input->post('ta',true),
		];
		$this->db->insert('db_ta', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('ta'));
	}

	public function edit($id)
	{
		$data['ta']=$this->db->get_where('db_ta',['id_ta'=>$id])->row_array();
		$this->load->view('ta/edit',$data);
	}

	// public function update()
	// {
	// 	$data=[
	// 		'ta'=>$this->input->post('ta',true),
	// 	];
	// 	$this->db->where('id_ta',$this->input->post('id_ta',true));
	// 	$this->db->update('db_ta', $data);
	// 	$this->session->set_flashdata('message', 'Data berhasil di update !');
	// 	redirect(site_url('ta'));
	// }

	public function delete($id)
	{
		$this->db->delete('db_ta',['id_ta'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('ta'));
	}

}
