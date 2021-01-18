<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Krs_model');
		$this->load->model('Jadwal_model');
		$this->load->model('Khs_model');
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
		$data['title']='KHS';
		$ta=$this->db->get_where('db_ta',['status'=>'active'])->row_array();
		$data['ta']=$this->db->get('db_ta')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		// $data['jadwal']=$this->db->get('db_jadwal')->result();
		$data['jadwal']=$this->Jadwal_model->getJadwal($ta['ta']);
		if ($data['user']['level']=='admin') {
			$this->load->view('khs/index',$data);
		}else{
			echo 'retrsicted for '.$data['user']['level'];
		};
	}

	public function cari()
	{
		$data['angkatan']=$this->input->post()['angkatan'];
		$data['jurusan']=$this->input->post()['jurusan'];
		$this->load->view('khs/hasilCari', $data);
	}

	public function getAll()
	{
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$mhs = $this->Khs_model->get_mhs();

		$data = array();

		foreach($mhs->result() as $r) {

			$data[] = array(
				$r->nim,
				$r->nama_mhs,
				$r->nama_jurusan,
				$r->semester,
				"<button class='btn btn-success' data-toggle='modal' data-target='#modal-edit-jur' onclick='detail($r->nim)'>Detail</button>"
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $mhs->num_rows(),
			"recordsFiltered" => $mhs->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function getCustom($a, $jurusan)
	{
		$angkatan=$this->db->get_where('db_ta',['id_ta'=>$a])->row_array()['ta'];
		// $jurusan=$this->db->get_where('db_jurusan',['id_jur'=>$j])->row_array()['id_jur'];
		// echo $angkatan;
		// echo $jurusan;
		// die();
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$mhs = $this->Khs_model->get_mhsCustom($angkatan, $jurusan);

		$data = array();

		foreach($mhs->result() as $r) {

			$data[] = array(
				$r->nim,
				$r->nama_mhs,
				$r->nama_jurusan,
				$r->semester,
				"<button class='btn btn-success' data-toggle='modal' data-target='#modal-edit-jur' onclick='detail($r->nim)'>Detail</button>"
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $mhs->num_rows(),
			"recordsFiltered" => $mhs->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function detail($nim)
	{
		$mhs=$this->db->get_where('db_mahasiswa',['nim'=>$nim])->row_array();
		$get_jur=$this->db->get_where('db_jurusan',['kd_jurusan'=>$mhs['kd_jurusan']])->row_array();
		$collect=[];
		for ($i=1; $i <= $mhs['semester']; $i++) { 
			// cari taun ajar yang tepat dengan nim
			$ta=substr($nim, 0, 4)+floor((($i/2)-0.5));
			$ta1=$ta+1;
			strval($ta);
			strval($ta1);
			$ta_fix=$ta.'/'.$ta1;
			// end


			$krs=$this->db->get_where('db_paket_krs',['semester'=>$i,'ta'=>$ta_fix,'id_jurusan'=>$get_jur['id_jur']])->row_array();
			if ($krs!=null) {	
				$this->db->select('*');
				$this->db->from('db_nilai');
				$this->db->where(['id_krs'=>$krs['id_krs'],'nim'=>$nim]);
				$this->db->join('db_jadwal','db_jadwal.id_jadwal=db_nilai.id_jadwal');
				$items=$this->db->get()->result();
			// $items=$this->db->get_where('db_nilai',['id_krs'=>$krs['id_krs'],'nim'=>$nim])->result();
			}else{
				$krs=['null'];
				$items=['null'];
			}
			$collect[$i]=$krs;
			array_push($collect[$i], $items);
		};
		$data['collect']=$collect;
		$data['mhs']=$mhs;
		$data['jadwal']=$this->db->get('db_jadwal')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['jurusan']=$get_jur;
		// print_r($data['collect']);
		$this->load->view('khs/detail',$data);
		// $this->db->select('*');
		// $this->db->from('db_nilai');
		// $this->db->join('db_paket_krs','db_paket_krs.id_krs=db_nilai.id_krs');
		// $this->db->group_by('id_krs'); 
		// $this->db->order_by('id_krs', 'asc'); 
		// $this->db->where('db_nilai.nim',$nim);
		// $data=$this->db->get()->result();
		// print_r($data);
	}
}