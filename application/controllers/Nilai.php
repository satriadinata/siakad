<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ta_model');
		$this->load->model('Nilai_model');
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
	public function getMhs($id_jadwal)
	{
		$data['id_jadwal']=$id_jadwal;
		$this->load->view('dsn/tabel',$data);
	}
	public function getAll($id_jadwal)
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$nilais = $this->Nilai_model->get_nilai($id_jadwal);

		$data = array();

		foreach($nilais->result() as $r) {

			$data[] = array(
				$r->nim,
				$r->nama_mhs,
				$r->nilai,
				"<button class='btn btn-success' data-toggle='modal' data-target='#modal-edit-jur' onclick='ehe($r->id_nilai)'>Nilai</button>"
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $nilais->num_rows(),
			"recordsFiltered" => $nilais->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function edit($id)
	{
		$data['nilai']=$this->db->get_where('db_nilai',['id_nilai'=>$id])->row_array();
		$this->load->view('dsn/edit',$data);
	}

	public function update()
	{
		$nilai=$this->db->get_where('db_nilai',['id_nilai'=>$this->input->post('id_nilai')])->row_array();
		$mhs=$this->db->get_where('db_mahasiswa',['nim'=>$nilai['nim']])->row_array()['semester'];
		$data=[
			'nilai'=>$this->input->post('nilai',true),
		];
		$this->db->where('id_nilai',$this->input->post('id_nilai',true));
		$this->db->update('db_nilai', $data);
		echo "ok";
	}

	public function delete($id)
	{
		$this->db->delete('db_ta',['id_ta'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('ta'));
	}
	public function changePassword()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Change Password';
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['menu']=$this->getSemester($data['user']['username']);
		$this->load->view('change_password', $data);
	}
	public function changePass()
	{
		$this->load->library('form_validation');
		$data['iden']=$this->input->post();
		$user= $this->session->userdata('user_logged');
		$pass_get=$this->db->get_where('db_user',['username'=>$user['username']])->row_array()['password'];

		if ($pass_get==$data['iden']['password_lama']) {
			
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');

			if ($this->form_validation->run()) {
				$up=[
					'password'=>$this->input->post('password'),
				];
				$this->db->where('username',$user['username']);
				$this->db->update('db_user', $up);
				$this->session->set_flashdata('message', 'Success');
				redirect(site_url('nilai/changePassword'));
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect(site_url('nilai/changePassword'));
			};

		}else{

			$this->session->set_flashdata('error', 'Wrong Last Password');
			redirect(site_url('nilai/changePassword'));
		}
	}

}
