<?php

class Krs_model extends CI_Model
{
  private $_table="db_paket_krs";

  public function filter($search, $limit, $start, $order_field, $order_ascdesc){

    $this->db->join('db_jurusan','db_jurusan.id_jur = db_paket_krs.id_jurusan');
    $this->db->join('db_dosen','db_dosen.id_dosen = db_paket_krs.id_pa');
    $this->db->like('ta', $search);
    $this->db->or_like('semester', $search);
    $this->db->or_like('nama_dosen', $search);
    $this->db->or_like('nama_jurusan', $search);
    $this->db->or_like('ketua_jurusan', $search);
    $this->db->or_like('status', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
  }
  public function count_all(){
    return $this->db->count_all($this->_table);
  }

  public function count_filter($search){
    $this->db->join('db_jurusan','db_jurusan.id_jur = db_paket_krs.id_jurusan');
    $this->db->join('db_dosen','db_dosen.id_dosen = db_paket_krs.id_pa');
    $this->db->like('ta', $search);
    $this->db->or_like('semester', $search);
    $this->db->or_like('nama_dosen', $search);
    $this->db->or_like('nama_jurusan', $search);
    $this->db->or_like('ketua_jurusan', $search);
    $this->db->or_like('status', $search);
    return $this->db->get($this->_table)->num_rows();
  }

}
?>