<?php

class Jurusan_model extends CI_Model
{
    private $_table="db_jurusan";

    public function filter($search, $limit, $start, $order_field, $order_ascdesc){

        $this->db->like('kd_jurusan', $search); // Untuk menambahkan query where LIKE
        $this->db->or_like('nama_jurusan', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('ketua_jurusan', $search); // Untuk menambahkan query where OR LIKE
        $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
        $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
        return $this->db->get('db_jurusan')->result_array(); // Eksekusi query sql sesuai kondisi diatas
    }
    public function count_all(){
        return $this->db->count_all('db_jurusan'); // Untuk menghitung semua data siswa
    }

    public function count_filter($search){
      $this->db->like('kd_jurusan', $search); // Untuk menambahkan query where LIKE
      $this->db->or_like('nama_jurusan', $search); // Untuk menambahkan query where OR LIKE
      $this->db->or_like('ketua_jurusan', $search); // Untuk menambahkan query where OR LIKE
      return $this->db->get('db_jurusan')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
    }


}



?>