<?php

class User_model extends CI_Model
{
    private $_table="db_user";

    public function doLogin() {
        $password=$this->input->post('password');
        $username=$this->input->post('username');
        $user=$this->db->get_where('db_user', ['username'=>$username])->row_array();

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
                $err['pass']='Wrong Password';
                $this->load->view('auth/login');
                return false;
            }
        }
    }

    public function doLogout(){
       $this->session->sess_destroy();
       return true;
   }
}



?>