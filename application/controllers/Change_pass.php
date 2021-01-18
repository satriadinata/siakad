<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_pass extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ta_model');
		$this->load->model('Nilai_model');
		$user = $this->session->userdata('user_logged');
		if ($user==null) {
			redirect(site_url('auth'));
		};
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
	
	public function changePassword()
	{
		$data['user']= $this->session->userdata('user_logged');
		$data['title']='Change Password';
		$data['ta']=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['menu']=$this->getSemester($data['user']['username']);
		if ($data['user']['level']=='dosen') {
			$this->load->view('change_password_dsn', $data);
		}elseif($data['user']['level']=='mhs'){
			$data['mhs']=$this->db->get_where('db_mahasiswa',['nim'=>$data['user']['username']])->row_array();
			$this->load->view('change_password_mhs', $data);
		}
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
				redirect(site_url('change_pass/changePassword'));
			}else{
				$this->session->set_flashdata('error', validation_errors());
				redirect(site_url('change_pass/changePassword'));
			};

		}else{

			$this->session->set_flashdata('error', 'Wrong Last Password');
			redirect(site_url('change_pass/changePassword'));
		}
	}

}
