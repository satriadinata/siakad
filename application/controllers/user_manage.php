<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_manage extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
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
		$data['title']="User Management";
		$data['all']=$this->db->get('db_user')->result();
		if ($data['user']['level']=='admin') {
			$this->load->view('user_manage', $data);
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
		$sql_total = $this->User_model->count_all();
		$sql_data = $this->User_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->User_model->count_filter($search);
		$callback = array(
			'draw'=>$_POST['draw'],
			'recordsTotal'=>$sql_total,
			'recordsFiltered'=>$sql_filter,
			'data'=>$sql_data
		);
		header('Content-Type: application/json');
		echo json_encode($callback);
	}
	public function unlock()
	{
		$data=[
			'blokir'=>'n',
		];
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('db_user', $data);
	}
	public function lock()
	{
		$data=[
			'blokir'=>'y',
		];
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('db_user', $data);
	}
	public function changePass($id)
	{
		$data['pass']=$this->db->get_where('db_user',['id'=>$id])->row_array();
		$this->load->view('editPass',$data);
	}
	public function det()
	{
		$up=[
			'password'=>$this->input->post()['password'],
		];
		$this->db->where('id',$this->input->post()['id']);
		$this->db->update('db_user', $up);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('user_manage'));	
	}

}
