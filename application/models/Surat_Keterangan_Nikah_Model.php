<?php

class Surat_Keterangan_Nikah_Model extends CI_Model
{


    function construct()
    {
        parent::__construct();
    }

    function get_all_surat()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_nikah ORDER BY tanggal ASC");

        $indeks = 0;
        $result = array();

        foreach ($query->result_array() as $row) {
            $result[$indeks++] = $row;
        }

        return $result;
    }

    function select_data_surat_byId($id)
    {
        $this->db->select('*');
        $this->db->from('surat_keterangan_nikah');
        $this->db->where('id', $id);

        return $this->db->get();
    }

    function delete_surat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('surat_keterangan_nikah');
    }
}
