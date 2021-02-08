<?php

class Operator_Model extends CI_Model
{


    function construct()
    {
        parent::__construct();
    }

    function get_all_operator()
    {
        $query = $this->db->query("SELECT * FROM user WHERE level = 'operator' ");

        $indeks = 0;
        $result = array();

        foreach ($query->result_array() as $row) {
            $result[$indeks++] = $row;
        }

        return $result;
    }

    function delete_operator($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    function reset_password($id)
    {
        $data_update_operator = array(
            'password' => md5('operator')
        );
        $data['operator'] = $data_update_operator;

        $this->db->update('user', $data_update_operator, array('id' => $id));
    }
}
