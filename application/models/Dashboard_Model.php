<?php

class Dashboard_Model extends CI_Model
{


    function construct()
    {
        parent::__construct();
    }

    function get_total_operator()
    {
        $query = $this->db->query("SELECT * FROM user WHERE level = 'operator' ");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_masuk()
    {
        $query = $this->db->query("SELECT * FROM surat_masuk");

        $count = $query->num_rows();

        return $count;
    }
    function get_total_surat_keluar()
    {
        $query = $this->db->query("SELECT * FROM surat_keluar");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_nikah()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_nikah");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_usaha()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_usaha");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_catatan_kepolisian()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_catatan_kepolisian");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_izin_kayu()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_izin_kayu");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_ahli_waris()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_ahli_waris");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_kematian()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_kematian");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_tidak_mampu()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_tidak_mampu");

        $count = $query->num_rows();

        return $count;
    }

    function get_total_surat_keterangan_lainnya()
    {
        $query = $this->db->query("SELECT * FROM surat_keterangan_lainnya");

        $count = $query->num_rows();

        return $count;
    }
}
