<?php

class Matkul_model extends CI_Model
{
    private $_table="db_makul";

    public function filter($search, $limit, $start, $order_field, $order_ascdesc){
        $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_makul.kd_jurusan');
        $this->db->like('kode_mk', $search); // Untuk menambahkan query where LIKE
        $this->db->or_like('nama_mk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('sks', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('semester', $search); // Untuk menambahkan query where OR LIKE
        $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
        $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
        return $this->db->get('db_makul')->result_array(); // Eksekusi query sql sesuai kondisi diatas
    }
    public function count_all(){
        return $this->db->count_all('db_makul'); // Untuk menghitung semua data siswa
    }

    public function count_filter($search){
        $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_makul.kd_jurusan');
      $this->db->like('kode_mk', $search); // Untuk menambahkan query where LIKE
      $this->db->or_like('nama_mk', $search); // Untuk menambahkan query where OR LIKE
      $this->db->or_like('sks', $search); // Untuk menambahkan query where OR LIKE
      $this->db->or_like('semester', $search); // Untuk menambahkan query where OR LIKE
      return $this->db->get('db_makul')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }


}



?>