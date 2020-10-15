<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Krs_model');
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
		$data['title']='KRS';
		$data['ta']=$this->db->get('db_ta')->result();
		$data['jurusan']=$this->db->get('db_jurusan')->result();
		$data['dosen']=$this->db->get('db_dosen')->result();
		$data['makul']=$this->db->get('db_makul')->result();
		if ($data['user']['level']=='admin') {
			$this->load->view('krs/index',$data);
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
		$sql_total = $this->Krs_model->count_all();
		$sql_data = $this->Krs_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
		$sql_filter = $this->Krs_model->count_filter($search);
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
		$ta=$this->db->get_where('db_ta',['id_ta'=>$this->input->post('ta')])->row_array();
		$mhs=$this->db->get_where('db_mahasiswa',['semester'=>$this->input->post('semester')])->result();
		$data=[
			'id_ta'=>$this->input->post('ta'),
			'ta'=>$ta['ta'],
			'semester'=>$this->input->post('semester'),
			'id_jurusan'=>$this->input->post('id_jur'),
			'id_pa'=>$this->input->post('pa'),
		];
		$this->db->insert('db_paket_krs', $data);
		$insert_id=$this->db->insert_id();
		$item=$this->input->post('krs');
		foreach ($item as $value) {
			$v=explode('|',$value);
			$itemInput=[
				'id_krs'=>$insert_id,
				'kode_mk'=>$v[0],
				'kode_dosen'=>$v[1],
			];
			$this->db->insert('db_item_krs', $itemInput);
		};
		// foreach ($mhs as $m) {
		// 	foreach ($item as $value) {
		// 		$v=explode('|',$value);
		// 		$a=[
		// 			'id_krs'=>$insert_id,
		// 			'ta'=>$ta['ta'],
		// 			'nim'=>$m->nim,
		// 			'kd_mk'=>$v[0],
		// 			'kd_dosen'=>$v[1],
		// 		];
		// 		$this->db->insert('db_nilai', $a);
		// 	};
		// };
	}

	public function edit($id)
	{
		$data['jurusan']=$this->db->get_where('db_jurusan',['id_jur'=>$id])->row_array();
		$this->load->view('jurusan/edit',$data);
	}

	public function update()
	{
		$data=[
			'kd_jurusan'=>$this->input->post('kd_jurusan',true),
			'nama_jurusan'=>$this->input->post('nama_jurusan',true),
			'ketua_jurusan'=>$this->input->post('ketua_jurusan',true),
		];
		$this->db->where('id_jur',$this->input->post('id_jur',true));
		$this->db->update('db_jurusan', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update !');
		redirect(site_url('jurusan'));
	}

	public function delete($id)
	{
		$this->db->delete('db_paket_krs',['id_krs'=>$id]);
		$this->session->set_flashdata('message', 'Data berhasil dihapus !');
		redirect(site_url('krs'));
	}
}
