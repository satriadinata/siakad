<?php

class Khs_model extends CI_Model
{
  // private $_table="db_mahasiswa";

  public function get_mhs()
  {
   $this->db->select('*');
   $this->db->from('db_mahasiswa');
   $this->db->join('db_jurusan','db_jurusan.kd_jurusan=db_mahasiswa.kd_jurusan',);
   // $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_mahasiswa.kd_jurusan');
   // $this->db->where('db_nilai.id_jadwal', $id);
   $query=$this->db->get();
   return $query;
 }

}
?>