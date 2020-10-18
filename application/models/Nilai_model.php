<?php

class Nilai_model extends CI_Model
{
  private $_table="db_nilai";

  public function get_nilai($id)
  {
   $this->db->select('*');
   $this->db->from('db_nilai');
   $this->db->join('db_mahasiswa','db_mahasiswa.nim=db_nilai.nim',);
   $this->db->join('db_jurusan','db_jurusan.kd_jurusan = db_mahasiswa.kd_jurusan');
   $this->db->where('db_nilai.id_jadwal', $id);
   $query=$this->db->get();
   return $query;
 }

}
?>