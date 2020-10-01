<?php

class Matkul_model extends CI_Model
{
  private $_table="db_makul";

  public function filter($search, $limit, $start, $order_field, $order_ascdesc){
    $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_makul.kd_jurusan');
    $this->db->like('kode_mk', $search);
    $this->db->or_like('nama_mk', $search);
    $this->db->or_like('sks', $search);
    $this->db->or_like('semester', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }
  public function count_all(){
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search){
    $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_makul.kd_jurusan');
    $this->db->like('kode_mk', $search);
    $this->db->or_like('nama_mk', $search);
    $this->db->or_like('sks', $search);
    $this->db->or_like('semester', $search);
    return $this->db->get($this->_table)->num_rows();
  }

}
?>