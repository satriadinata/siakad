<?php

class Ta_model extends CI_Model
{
    private $_table="db_ta";

    public function filter($search, $limit, $start, $order_field, $order_ascdesc){

        $this->db->like('ta', $search);
        $this->db->or_like('status', $search);
        return $this->db->get($this->_table)->result_array();
    }
    public function count_all(){
        return $this->db->count_all($this->_table);
    }

    public function count_filter($search){
      $this->db->like('ta', $search);
      $this->db->or_like('status', $search);
      return $this->db->get($this->_table)->num_rows();
  }

}

?>