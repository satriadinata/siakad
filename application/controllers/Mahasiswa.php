<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mahasiswa_model');
		$this->load->library('form_validation');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	
	public function index()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Mahasiswa';

		if ($data['user']['level']=='admin') {
			$this->load->view('mahasiswa/index',$data);
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
		$this->form_validation->set_rules('nim','NIM','required|is_unique[db_mahasiswa.nim]');
		// echo "<pre>";
		// print_r($this->input->post());
		// print_r($_FILES['foto']);
		// echo "</pre>";
		// die();
		if($this->form_validation->run() != false){
			$data = $this->input->post();

			if (array($_FILES['foto'])!=null) {
				$config['upload_path']          = './uploads/foto_mhs/';
				$config['file_name']            = 'mhs_'.date('YmdHis').'_'.uniqid();
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('mahasiswa/create'));
				}else{
					$data['foto_mhs'] = 'foto_mhs/'.$this->upload->data("file_name");
					$this->db->insert('db_mahasiswa', $data);
					$this->session->set_flashdata('message', 'Data dan foto berhasil di input !');
					// $this->session->set_flashdata('message', $this->upload->display_errors());
					redirect(site_url('mahasiswa'));
					echo "berhasil";
				}
			}else{

				$this->db->insert('db_mahasiswa', $data);
				$this->session->set_flashdata('message', 'Data berhasil di input !');
				redirect(site_url('mahasiswa'));
			}
		}else{
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('mahasiswa/create'));
		}
		

			// $this->session->set_flashdata('error', $this->upload->display_errors());
			// $this->session->set_flashdata('input', $data);
			// redirect(site_url('mahasiswa/create'));
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
		$data['p']=$this->db->get_where('db_mahasiswa',['id_mhs'=>$data['id_mhs']])->row_array();
		// echo $data['p']['nim'];
		// echo $data['nim'];
		// die();
		if ($data['nim']!=$data['p']['nim']) {
			$this->form_validation->set_rules('nim','NIM','is_unique[db_mahasiswa.nim]');
			echo "ehe";
			die();
		};
		// echo "<pre>";
		// print_r($this->input->post());
		// print_r($_FILES['foto']);
		// echo "</pre>";
		// die();
		if($this->form_validation->run() != false){

			if (!empty($_FILES['foto'])) {
				$config['upload_path']          = './uploads/foto_mhs/';
				$config['file_name']            = 'mhs_'.date('YmdHis').'_'.uniqid();
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 1024;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					echo "string";
					die();
					redirect(site_url('mahasiswa/edit/'.$this->input->post('id_mhs')));
				}else{
					$this->db->where('id_mhs',$this->input->post('id_mhs',true));
					$this->db->update('db_mahasiswa', [
						'nim'=>$this->input->post('nim',true),
						'nik_mhs'=>$this->input->post('nik_mhs',true),
						'kd_jurusan'=>$this->input->post('kd_jurusan',true),
						'nama_mhs'=>$this->input->post('nama_mhs',true),
						'alamat'=>$this->input->post('alamat',true),
						'telp'=>$this->input->post('telp',true),
						'tempat_lahir'=>$this->input->post('tempat_lahir',true),
						'tgl_lahir'=>$this->input->post('tgl_lahir',true),
						'agama_mhs'=>$this->input->post('agama_mhs',true),
						'kewarganegaraan'=>$this->input->post('kewarganegaraan',true),
						'nama_ortu'=>$this->input->post('nama_ortu',true),
						'alamat_ortu'=>$this->input->post('alamat_ortu',true),
						'telp_ortu'=>$this->input->post('telp_ortu',true),
						'foto_mhs'=>'foto_mhs/'.$this->upload->data("file_name"),
					]);
					$this->session->set_flashdata('message', 'Data dan foto berhasil di Update !');
					redirect(site_url('mahasiswa'));
				}
			}else{

				// $this->db->insert('db_mahasiswa', $data);
				echo "mbuh";
				die();
				$this->db->where('id_mhs',$this->input->post('id_mhs',true));
				$this->db->update('db_mahasiswa', [
					'nim'=>$this->input->post('nim',true),
					'nik_mhs'=>$this->input->post('nik_mhs',true),
					'kd_jurusan'=>$this->input->post('kd_jurusan',true),
					'nama_mhs'=>$this->input->post('nama_mhs',true),
					'alamat'=>$this->input->post('alamat',true),
					'telp'=>$this->input->post('telp',true),
					'tempat_lahir'=>$this->input->post('tempat_lahir',true),
					'tgl_lahir'=>$this->input->post('tgl_lahir',true),
					'agama_mhs'=>$this->input->post('agama_mhs',true),
					'kewarganegaraan'=>$this->input->post('kewarganegaraan',true),
					'nama_ortu'=>$this->input->post('nama_ortu',true),
					'alamat_ortu'=>$this->input->post('alamat_ortu',true),
					'telp_ortu'=>$this->input->post('telp_ortu',true),
				]);
				$this->session->set_flashdata('message', 'Data berhasil di Update !');
				redirect(site_url('mahasiswa'));
			}
		}else{
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('mahasiswa/edit/'.$this->input->post('id_mhs')));
		}
	}

	public function delete($id)
	{
		$this->db->delete('db_jurusan',['id_jur'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('jurusan'));
	}
}
