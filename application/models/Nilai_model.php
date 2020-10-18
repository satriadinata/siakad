<?php

class Matkul_model extends CI_Model
{
  private $_table="db_nilai";

  public function filter($search, $limit, $start, $order_field, $order_ascdesc){
    $this->db->join('db_mahasiswa','db_mahasiswa.nim = db_nilai.nim');
    $this->db->like('id_krs', $search);
    $this->db->or_like('id_jadwal', $search);
    $this->db->or_like('nama_mhs', $search);
    $this->db->or_like('ta', $search);
    $this->db->or_like('nim', $search);
    $this->db->where();
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }
  public function count_all(){
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search){
    $this->db->join('db_mahasiswa','db_mahasiswa.nim = db_nilai.nim');
    $this->db->like('id_krs', $search);
    $this->db->or_like('id_jadwal', $search);
    $this->db->or_like('nama_mhs', $search);
    $this->db->or_like('ta', $search);
    $this->db->or_like('nim', $search);
    $this->db->where();
    return $this->db->get($this->_table)->num_rows();
  }

}
?>