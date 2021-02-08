<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('notification', '<div class="alert alert-danger" role="alert"> Silakan login terlebih dahulu!</div>');
            redirect('Auth');
        } else {
            if (!($this->session->userdata('level') == 'operator')) {
                $this->session->set_flashdata('notification', '<div class="alert alert-danger" role="alert">Anda bukan Operator!</div>');
                redirect('Auth');
            }
        }
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $this->load->model('Dashboard_Model');
        $data['total_operator'] = $this->Dashboard_Model->get_total_operator();
        $data['total_surat_masuk'] = $this->Dashboard_Model->get_total_surat_masuk();
        $data['total_surat_keluar'] = $this->Dashboard_Model->get_total_surat_keluar();
        $data['total_surat_keterangan_nikah'] = $this->Dashboard_Model->get_total_surat_keterangan_nikah();
        $data['total_surat_keterangan_usaha'] = $this->Dashboard_Model->get_total_surat_keterangan_usaha();
        $data['total_surat_keterangan_catatan_kepolisian'] = $this->Dashboard_Model->get_total_surat_keterangan_catatan_kepolisian();
        $data['total_surat_keterangan_izin_kayu'] = $this->Dashboard_Model->get_total_surat_keterangan_izin_kayu();
        $data['total_surat_keterangan_ahli_waris'] = $this->Dashboard_Model->get_total_surat_keterangan_ahli_waris();
        $data['total_surat_keterangan_kematian'] = $this->Dashboard_Model->get_total_surat_keterangan_kematian();
        $data['total_surat_keterangan_tidak_mampu'] = $this->Dashboard_Model->get_total_surat_keterangan_tidak_mampu();
        $data['total_surat_keterangan_lainnya'] = $this->Dashboard_Model->get_total_surat_keterangan_lainnya();

        $data['title'] = 'Dashboard';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/dashboard_operator');
        $this->load->view('template/footer');
    }
}
