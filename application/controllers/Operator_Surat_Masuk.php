<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_Surat_Masuk extends CI_Controller
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

        $this->load->model('Surat_Masuk_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_masuk'] = $this->Surat_Masuk_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Masuk';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/surat_masuk', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_masuk_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_masuk/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_masuk = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'pengirim' => $this->input->post('pengirim'),
                'isi_singkat' => $this->input->post('isi'),
                'file' => NULL
            );
            $data['surat_masuk'] = $surat_masuk;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_masuk['file'] = $file['file_name'];

                $this->db->insert('surat_masuk', $surat_masuk);
                $this->session->set_flashdata('notification_berhasil', 'Surat Masuk berhasil ditambahkan');
                redirect('Operator_Surat_Masuk');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Masuk gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Operator_Surat_Masuk');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Masuk gagal ditambahkan');
            redirect('Operator_Surat_Masuk');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_masuk_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_masuk/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_masuk = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'pengirim' => $this->input->post('pengirim'),
            'isi_singkat' => $this->input->post('isi'),
            'file' => $this->input->post('file_lama')
        );
        $data['edit_surat_masuk'] = $data_update_surat_masuk;

        if (($this->form_validation->run() == TRUE)) {
            $file = NULL;
            $iserror = false;
            if ((!empty($_FILES['file_baru']['name']))) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file_baru')) {
                    $data_file_lama = $this->input->post('file_lama');

                    $file = $this->upload->data();
                    $data_update_surat_masuk['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_masuk/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Masuk gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_masuk['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_masuk', $data_update_surat_masuk, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Masuk berhasil diubah');
                redirect('Operator_Surat_Masuk');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Masuk gagal diedit');
            redirect('Operator_Surat_Masuk');
        }
    }
}
