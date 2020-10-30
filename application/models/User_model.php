<?php

class User_model extends CI_Model
{
    private $_table="db_user";

    public function doLogin() {
        $password=$this->input->post('password');
        $username=$this->input->post('username');
        $user=$this->db->get_where($this->_table, ['username'=>$username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password']) && $user['blokir']=='n') {
                $data=[
                    'id'=>$user['id'],
                    'username'=>$user['username'],
                    'email'=>$user['email'],
                    'level'=>$user['level'],
                    'blokir'=>$user['blokir'],
                ];
                $this->session->set_userdata(['user_logged'=>$data]);
                return true;
            }else{
                $this->session->set_flashdata('errP','Wrong Password or Blocked');
                redirect('/'); 
            }
        }else{
            $this->session->set_flashdata('errP','Wrong Username');
            $this->load->view('auth/login');
            redirect('/'); 
        }
    }

    public function doLogout(){
     $this->session->sess_destroy();
     return true;
 }

 public function filter($search, $limit, $start, $order_field, $order_ascdesc){

    $this->db->like('username', $search);
    $this->db->or_like('email', $search);
    $this->db->or_like('blokir', $search);
    $this->db->or_like('level', $search);
    $this->db->order_by($order_field, $order_ascdesc);
    $this->db->limit($limit, $start);
    return $this->db->get($this->_table)->result_array();
}
public function count_all(){
    return $this->db->count_all($this->_table);
}

public function count_filter($search){
  $this->db->like('username', $search);
  $this->db->or_like('email', $search);
  $this->db->or_like('blokir', $search);
  $this->db->or_like('level', $search);
  return $this->db->get($this->_table)->num_rows();
}
}



?>