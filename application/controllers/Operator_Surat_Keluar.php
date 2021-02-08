<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_Surat_Keluar extends CI_Controller
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

        $this->load->model('Surat_Keluar_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_keluar'] = $this->Surat_Keluar_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Keluar';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/surat_keluar', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keluar_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keluar/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_keluar = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'tujuan' => $this->input->post('tujuan'),
                'isi_singkat' => $this->input->post('isi'),
                'file' => NULL
            );
            // $data['surat_keluar'] = $surat_keluar;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_keluar['file'] = $file['file_name'];

                $this->db->insert('surat_keluar', $surat_keluar);
                $this->session->set_flashdata('notification_berhasil', 'Surat Keluar berhasil ditambahkan');
                redirect('Operator_Surat_Keluar');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Keluar gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Operator_Surat_Keluar');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Keluar gagal ditambahkan, cek inputan anda');
            redirect('Operator_Surat_Keluar');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keluar_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keluar/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_keluar = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'tujuan' => $this->input->post('tujuan'),
            'isi_singkat' => $this->input->post('isi'),
            'file' => $this->input->post('file_lama')
        );
        // $data['edit_surat_keluar'] = $data_update_surat_keluar;

        if (($this->form_validation->run() == TRUE)) {
            $file = NULL;
            $iserror = false;
            if ((!empty($_FILES['file_baru']['name']))) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file_baru')) {
                    $data_file_lama = $this->input->post('file_lama');

                    $file = $this->upload->data();
                    $data_update_surat_keluar['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_keluar/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Keluar gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_keluar['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_keluar', $data_update_surat_keluar, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Keluar berhasil diubah');
                redirect('Operator_Surat_Keluar');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Keluar gagal diedit, cek inputan anda');
            redirect('Operator_Surat_Keluar');
        }
    }
}
