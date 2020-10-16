<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mahasiswa_model');
		$this->load->library('form_validation');
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
		$data['title']='Mahasiswa';

		if ($data['user']['level']=='admin') {
			$this->load->view('mahasiswa/index',$data);
		}
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
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['agama'] = [
			'Islam',
			'Kristen',
			'Katholik',
			'Buddha',
			'Hindu',
		];

		if ($data['user']['level']=='admin') {
			$this->load->view('mahasiswa/create',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function store()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('nim','NIM','required|is_unique[db_mahasiswa.nim]');
		$data['foto_mhs'] = 'default/male.png';

		if($this->form_validation->run() != false){

			if (isset($_FILES['foto']) && $_FILES['foto']['name'] != null) {
				$config['upload_path']          = './uploads/foto_mhs/';
				$config['file_name']            = 'mhs_'.date('YmdHis').'_'.uniqid();
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('input', $data);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('mahasiswa/create'));
				}else{
					$data['foto_mhs'] = 'foto_mhs/'.$this->upload->data("file_name");
				}
			}
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('mahasiswa/create'));
		}
		$this->db->insert('db_mahasiswa', $data);
		$this->db->insert('db_user', [
			'username'=>$data['nim'],
			'password'=>password_hash(date("dmY",strtotime($data['tgl_lahir'])), PASSWORD_DEFAULT),
			'level'=>'mhs'
		]);
		$this->session->set_flashdata('message', 'Data dan foto berhasil di input !');
		redirect(site_url('mahasiswa'));
	}

	public function import()
	{
		$this->load->library('excel');

		try{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$data = [];
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row <= $highestRow; $row++)
				{
					$data[$row]['nim'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$data[$row]['nik_mhs'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$data[$row]['kd_jurusan'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$data[$row]['nama_mhs'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$data[$row]['alamat'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$data[$row]['telp'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$data[$row]['tempat_lahir'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$data[$row]['tgl_lahir'] = gmdate("d-m-Y", ($worksheet->getCellByColumnAndRow(8, $row)->getValue() - 25569) * 86400);
					$data[$row]['agama_mhs'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$data[$row]['kewarganegaraan'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$data[$row]['nama_ortu'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$data[$row]['alamat_ortu'] = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$data[$row]['telp_ortu'] = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$data[$row]['foto_mhs'] = 'default/male.png';
				}
			}

			$this->db->insert_batch('db_mahasiswa', $data);
			$this->session->set_flashdata('message', 'Data berhasil di import !');
			redirect(site_url('mahasiswa'));
		}catch (Exception $e)
		{
			var_dump($e->getMessage());
			exit();
		}
	}

	public function edit($id)
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Edit Data Mahasiswa';
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['agama'] = [
			'Islam',
			'Kristen',
			'Buddha',
			'Hindu',
		];
		$data['mahasiswa']=$this->db->get_where('db_mahasiswa',['id_mhs'=>$id])->row_array();

		$this->load->view('mahasiswa/edit',$data);
	}

	public function update()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('nim','NIM','required');
		$mahasiswa = $this->db->get_where('db_mahasiswa',['id_mhs'=>$data['id_mhs']])->row_array();

		if ($data['nim'] != $mahasiswa['nim']) {
			$this->form_validation->set_rules('nim','NIM','is_unique[db_mahasiswa.nim]');
		}

		if($this->form_validation->run() != false){
			if (isset($_FILES['foto']) && $_FILES['foto']['name'] != null) {
				$config['upload_path']          = './uploads/foto_mhs/';
				$config['file_name']            = 'mhs_'.date('YmdHis').'_'.uniqid();
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('input', $data);
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('mahasiswa/edit/'.$data['id_mhs']));
				}else{
					
					$current_file = "uploads/".$mahasiswa['foto_mhs'];
					if(file_exists($current_file) && $mahasiswa['foto_mhs'] != 'default/male.png'){
						unlink($current_file);
					}
					$data['foto_mhs'] = 'foto_mhs/'.$this->upload->data("file_name");
				}
			}

		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('mahasiswa/edit/'.$this->input->post('id_mhs')));
		}

		$this->db->where('id_mhs', $data['id_mhs']);
		$this->db->update('db_mahasiswa', $data);

		$this->session->set_flashdata('message', 'Data berhasil diedit !');
		redirect(site_url('mahasiswa'));
	}

	public function delete($id)
	{
		$mahasiswa = $this->db->get_where('db_mahasiswa',['id_mhs'=>$id])->row_array();
		$current_file = "uploads/".$mahasiswa['foto_mhs'];
		if(file_exists($current_file) && $mahasiswa['foto_mhs'] != 'default/male.png'){
			unlink($current_file);
		}

		$user=$this->db->get_where('db_mahasiswa',['id_mhs'=>$id])->row_array();
		$this->db->delete('db_user',['username'=>$user['nim']]);
		$this->db->delete('db_mahasiswa',['id_mhs'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('mahasiswa'));
	}
}
