<?php

class Ta_model extends CI_Model
{
    private $_table="db_ta";

    public function filter($search, $limit, $start, $order_field, $order_ascdesc){

        $this->db->like('ta', $search); // Untuk menambahkan query where LIKE
        return $this->db->get('db_ta')->result_array(); // Eksekusi query sql sesuai kondisi diatas
    }
    public function count_all(){
        return $this->db->count_all('db_ta'); // Untuk menghitung semua data siswa
    }

    public function count_filter($search){
      $this->db->like('ta', $search); // Untuk menambahkan query where LIKE
      return $this->db->get('db_ta')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
    }


}

?>