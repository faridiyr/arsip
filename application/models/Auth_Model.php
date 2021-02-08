<?php

class Auth_Model extends CI_Model
{


    function construct()
    {
        parent::__construct();
    }

    function cek_user_data($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        return $this->db->get();
    }

    function get_data_user_session($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);

        return $this->db->get();
    }

    public function get_password($id)
    {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('id', $id);

        return $this->db->get();
    }
}
