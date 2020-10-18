<?php

class User_model extends CI_Model
{
    private $_table="db_user";

    public function doLogin() {
        $password=$this->input->post('password');
        $username=$this->input->post('username');
        $user=$this->db->get_where($this->_table, ['username'=>$username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
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
                $this->session->set_flashdata('errP','Wrong Password');
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
}



?>