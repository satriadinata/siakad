<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ta_model');
		$user = $this->session->userdata('user_logged');
		if ($user==null) {
			redirect(site_url('auth'));
		}elseif ($user['level']!='dosen') {
			$this->load->view('error/error_404');
		};
	}

	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Home';
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['menu']=$this->getSemester($data['user']['username']);
		$this->load->view('dsn/index',$data);
	}
	public function getSemester($kd_dosen)
	{
		$ta=$this->db->get_where('db_ta',['status'=>'active'])->row_array()['ta'];
		$this->db->select('*');
		$this->db->from('db_jadwal');
		$this->db->join('db_makul','db_makul.kode_mk=db_jadwal.kd_mk',);
		$this->db->where('db_jadwal.ta', $ta);
		$this->db->where('db_jadwal.kd_dosen', $kd_dosen);
		$this->db->group_by('semester');
		$query=$this->db->get()->result();
		return $query;
	}
	public function getList($kd_dosen,$semester)
	{
		$ta=$this->db->get_where('db_ta',['status'=>'active'])->row_array()['ta'];
		$this->db->select('*');
		$this->db->from('db_jadwal');
		$this->db->join('db_makul','db_makul.kode_mk=db_jadwal.kd_mk',);
		$this->db->where('db_jadwal.ta', $ta);
		$this->db->where('db_jadwal.kd_dosen', $kd_dosen);
		$this->db->where('db_makul.semester', $semester);
		$query=$this->db->get()->result();
		return $query;
	}
	public function semester($id)
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Nilai';
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['menu']=$this->getSemester($data['user']['username']);
		$data['mk']=$this->getList($data['user']['username'],$id);
		// echo "<pre>";
		// print_r($data['mk']);
		// echo "</pre>";
		$this->load->view('dsn/nilai',$data);
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
			'ta'=>$this->input->post('ta'),
			'status'=>'deactive',
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

	public function delete($id)
	{
		$this->db->delete('db_ta',['id_ta'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('ta'));
	}
	public function active()
	{
		$data=$this->input->post();
		$aktif=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		if ($aktif!=null) {
			$this->db->where('id_ta',$aktif['id_ta']);
			$this->db->update('db_ta', ['status'=>'deactive']);

			$this->db->where('id_ta',$data['id']);
			$this->db->update('db_ta', ['status'=>'active']);
		}else{
			$this->db->where('id_ta',$data['id']);
			$this->db->update('db_ta', ['status'=>'active']);
		};
	}

}
