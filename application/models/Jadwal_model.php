<?php

class Jadwal_model extends CI_Model
{
  private $_table="db_jadwal";

  public function filter($search, $limit, $start, $order_field, $order_ascdesc){
    $this->db->join('db_makul','db_makul.kode_mk = db_jadwal.kd_mk');
    $this->db->join('db_dosen','db_dosen.kd_dosen = db_jadwal.kd_dosen');
    $this->db->like('kd_mk', $search);
    $this->db->or_like('nama_mk', $search);
    // $this->db->or_like('kd_dosen', $search);
    $this->db->or_like('nama_dosen', $search);
    $this->db->or_like('hari', $search);
    $this->db->or_like('jam', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }
  public function count_all(){
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search){
    $this->db->join('db_makul','db_makul.kode_mk = db_jadwal.kd_mk');
    $this->db->join('db_dosen','db_dosen.kd_dosen = db_jadwal.kd_dosen');
    $this->db->like('kd_mk', $search);
    $this->db->or_like('nama_mk', $search);
    // $this->db->or_like('kd_dosen', $search);
    $this->db->or_like('nama_dosen', $search);
    $this->db->or_like('hari', $search);
    $this->db->or_like('jam', $search);
    return $this->db->get($this->_table)->num_rows();
  }
  public function getJadwal()
  {
    $this->db->select('*');
    $this->db->from('db_jadwal');
    $this->db->join('db_makul','db_makul.kode_mk=db_jadwal.kd_mk',);
    $this->db->join('db_dosen','db_dosen.kd_dosen=db_jadwal.kd_dosen',);
    $query=$this->db->get()->result();
    return $query;
  }

}
?>