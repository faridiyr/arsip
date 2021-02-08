<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_Surat_Keterangan_Nikah extends CI_Controller
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

        $this->load->model('Surat_Keterangan_Nikah_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_keterangan_nikah'] = $this->Surat_Keterangan_Nikah_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Keterangan Nikah';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/surat_keterangan_nikah', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama_suami', 'Nama Suami', 'required');
        $this->form_validation->set_rules('tempat_lahir_suami', 'Tempat Lahir Suami', 'required');
        $this->form_validation->set_rules('tanggal_lahir_suami', 'Tanggal Lahir Suami', 'required');
        $this->form_validation->set_rules('suku_suami', 'Suku Suami', 'required');
        $this->form_validation->set_rules('pekerjaan_suami', 'Pekerjaan Suami', 'required');
        $this->form_validation->set_rules('nama_ortu_suami', 'Nama Ortu Suami', 'required');
        $this->form_validation->set_rules('alamat_suami', 'Alamat Suami', 'required');
        $this->form_validation->set_rules('nama_istri', 'Nama Istri', 'required');
        $this->form_validation->set_rules('tempat_lahir_istri', 'Tempat Lahir Istri', 'required');
        $this->form_validation->set_rules('tanggal_lahir_istri', 'Tanggal Lahir Istri', 'required');
        $this->form_validation->set_rules('suku_istri', 'Suku Istri', 'required');
        $this->form_validation->set_rules('pekerjaan_istri', 'Pekerjaan Istri', 'required');
        $this->form_validation->set_rules('nama_ortu_istri', 'Nama Ortu Istri', 'required');
        $this->form_validation->set_rules('alamat_istri', 'Alamat Istri', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_nikah_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_nikah/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_keterangan_nikah = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'nama_suami' => $this->input->post('nama_suami'),
                'tempat_lahir_suami' => $this->input->post('tempat_lahir_suami'),
                'tanggal_lahir_suami' => $this->input->post('tanggal_lahir_suami'),
                'suku_suami' => $this->input->post('suku_suami'),
                'pekerjaan_suami' => $this->input->post('pekerjaan_suami'),
                'nama_ortu_suami' => $this->input->post('nama_ortu_suami'),
                'alamat_suami' => $this->input->post('alamat_suami'),
                'nama_istri' => $this->input->post('nama_istri'),
                'tempat_lahir_istri' => $this->input->post('tempat_lahir_istri'),
                'tanggal_lahir_istri' => $this->input->post('tanggal_lahir_istri'),
                'suku_istri' => $this->input->post('suku_istri'),
                'pekerjaan_istri' => $this->input->post('pekerjaan_istri'),
                'nama_ortu_istri' => $this->input->post('nama_ortu_istri'),
                'alamat_istri' => $this->input->post('alamat_istri'),
                'file' => NULL
            );

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_keterangan_nikah['file'] = $file['file_name'];

                $this->db->insert('surat_keterangan_nikah', $surat_keterangan_nikah);
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Nikah berhasil ditambahkan');
                redirect('Operator_Surat_Keterangan_Nikah');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Nikah gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Operator_Surat_Keterangan_Nikah');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Nikah gagal ditambahkan, cek inputan anda');
            redirect('Operator_Surat_Keterangan_Nikah');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama_suami', 'Nama Suami', 'required');
        $this->form_validation->set_rules('tempat_lahir_suami', 'Tempat Lahir Suami', 'required');
        $this->form_validation->set_rules('tanggal_lahir_suami', 'Tanggal Lahir Suami', 'required');
        $this->form_validation->set_rules('suku_suami', 'Suku Suami', 'required');
        $this->form_validation->set_rules('pekerjaan_suami', 'Pekerjaan Suami', 'required');
        $this->form_validation->set_rules('nama_ortu_suami', 'Nama Ortu Suami', 'required');
        $this->form_validation->set_rules('alamat_suami', 'Alamat Suami', 'required');
        $this->form_validation->set_rules('nama_istri', 'Nama Istri', 'required');
        $this->form_validation->set_rules('tempat_lahir_istri', 'Tempat Lahir Istri', 'required');
        $this->form_validation->set_rules('tanggal_lahir_istri', 'Tanggal Lahir Istri', 'required');
        $this->form_validation->set_rules('suku_istri', 'Suku Istri', 'required');
        $this->form_validation->set_rules('pekerjaan_istri', 'Pekerjaan Istri', 'required');
        $this->form_validation->set_rules('nama_ortu_istri', 'Nama Ortu Istri', 'required');
        $this->form_validation->set_rules('alamat_istri', 'Alamat Istri', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_nikah_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_nikah/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_keterangan_nikah = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'nama_suami' => $this->input->post('nama_suami'),
            'tempat_lahir_suami' => $this->input->post('tempat_lahir_suami'),
            'tanggal_lahir_suami' => $this->input->post('tanggal_lahir_suami'),
            'suku_suami' => $this->input->post('suku_suami'),
            'pekerjaan_suami' => $this->input->post('pekerjaan_suami'),
            'nama_ortu_suami' => $this->input->post('nama_ortu_suami'),
            'alamat_suami' => $this->input->post('alamat_suami'),
            'nama_istri' => $this->input->post('nama_istri'),
            'tempat_lahir_istri' => $this->input->post('tempat_lahir_istri'),
            'tanggal_lahir_istri' => $this->input->post('tanggal_lahir_istri'),
            'suku_istri' => $this->input->post('suku_istri'),
            'pekerjaan_istri' => $this->input->post('pekerjaan_istri'),
            'nama_ortu_istri' => $this->input->post('nama_ortu_istri'),
            'alamat_istri' => $this->input->post('alamat_istri'),
            'file' => $this->input->post('file_lama')
        );

        if (($this->form_validation->run() == TRUE)) {
            $file = NULL;
            $iserror = false;
            if ((!empty($_FILES['file_baru']['name']))) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file_baru')) {
                    $data_file_lama = $this->input->post('file_lama');

                    $file = $this->upload->data();
                    $data_update_surat_keterangan_nikah['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_keterangan_nikah/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Nikah gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_keterangan_nikah['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_keterangan_nikah', $data_update_surat_keterangan_nikah, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Nikah berhasil diubah');
                redirect('Operator_Surat_Keterangan_Nikah');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Nikah gagal diedit, cek inputan anda');
            redirect('Operator_Surat_Keterangan_Nikah');
        }
    }
}
