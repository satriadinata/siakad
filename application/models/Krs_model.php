<?php

class Krs_model extends CI_Model
{
  private $_table="db_paket_krs";

  public function filter($search, $limit, $start, $order_field, $order_ascdesc){

    $this->db->like('kd_jurusan', $search);
    $this->db->or_like('nama_jurusan', $search);
    $this->db->or_like('ketua_jurusan', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }
  public function count_all(){
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search){
    $this->db->like('kd_jurusan', $search);
    $this->db->or_like('nama_jurusan', $search);
    $this->db->or_like('ketua_jurusan', $search);
    return $this->db->get($this->_table)->num_rows();
  }
  public function post($data){
    $this->db->insert('db_paket_krs', $data);
    $insert_id=$this->db->insert_id();
    return $insert_id;
  }

}
?>