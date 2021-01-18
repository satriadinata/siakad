<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Dosen_model');
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
		$data['foto_dosen'] = 'default/male.png';

		

		if (isset($_FILES['foto']) && $_FILES['foto']['name'] != null) {
			$config['upload_path']          = './uploads/foto_dosen/';
			$config['file_name']            = 'dosen_'.date('YmdHis').'_'.uniqid();
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 1024;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('foto')){
				$this->session->set_flashdata('input', $data);
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect(site_url('dosen/create'));
			}else{
				$data['foto_dosen'] = 'foto_dosen/'.$this->upload->data("file_name");
				$this->db->insert('db_dosen', $data);
				$this->session->set_flashdata('message', 'Data dan foto berhasil di input !');
				redirect(site_url('dosen'));
			}
		}
		$this->db->insert('db_dosen', $data);
		$this->db->insert('db_user', [
			'username'=>$data['kd_dosen'],
			'password'=>'dosendosen',
			'level'=>'dosen'
		]);
		$this->session->set_flashdata('message', 'Data berhasil di input !');
		redirect(site_url('dosen'));
	}

	public function edit($id)
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Tambah Data Dosen';
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['agama'] = [
			'Islam',
			'Kristen',
			'Katholik',
			'Buddha',
			'Hindu',
		];
		$data['dosen']=$this->db->get_where('db_dosen',['id_dosen'=>$id])->row_array();

		$this->load->view('dosen/edit',$data);
	}

	public function update()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('kd_dosen','kd_dosen','required');
		$dosen = $this->db->get_where('db_dosen',['id_dosen'=>$data['id_dosen']])->row_array();

		if ($data['kd_dosen'] != $dosen['kd_dosen']) {
			$this->form_validation->set_rules('kd_dosen','kd_dosen','is_unique[db_dosen.kd_dosen]');
		}

		if($this->form_validation->run() != false){
			if (isset($_FILES['foto']) && $_FILES['foto']['name'] != null) {
				$config['upload_path']          = './uploads/foto_dosen/';
				$config['file_name']            = 'mhs_'.date('YmdHis').'_'.uniqid();
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('input', $data);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('dosen/edit/'.$data['id_dosen']));
				}else{
					$current_file = "uploads/".$dosen['foto_dosen'];
					if(file_exists($current_file) && $dosen['foto_dosen'] != 'default/male.png'){
						unlink($current_file);
					}

					$data['foto_dosen'] = 'foto_dosen/'.$this->upload->data("file_name");
				}
			}

		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('dosen/edit/'.$this->input->post('id_dosen')));
		}

		$this->db->where('id_dosen', $data['id_dosen']);
		$this->db->update('db_dosen', $data);

		$this->session->set_flashdata('message', 'Data berhasil diedit !');
		redirect(site_url('dosen'));
	}

	public function delete($id)
	{
		$dosen = $this->db->get_where('db_dosen',['id_dosen'=>$id])->row_array();
		$current_file = "uploads/".$dosen['foto_dosen'];
		if(file_exists($current_file) && $dosen['foto_dosen'] != 'default/male.png'){
			unlink($current_file);
		}

		$this->db->delete('db_dosen',['id_dosen'=>$id]);
		$this->db->delete('db_user',['username'=>$dosen['kd_dosen']]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('dosen'));
	}
	public function changePassword()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Change Password';
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['menu']=$this->getSemester($data['user']['username']);
		$this->load->view('change_password', $data);
	}
}
