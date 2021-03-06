<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Keterangan_Usaha extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->set_flashdata('notification', '<div class="alert alert-danger" role="alert"> Silakan login terlebih dahulu!</div>');
            redirect('Auth');
        } else {
            if (!($this->session->userdata('level') == 'admin')) {
                $this->session->set_flashdata('notification', '<div class="alert alert-danger" role="alert">Anda bukan Admin!</div>');
                redirect('Auth');
            }
        }

        $this->load->model('Surat_Keterangan_Usaha_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_keterangan_usaha'] = $this->Surat_Keterangan_Usaha_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Keterangan Usaha';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('template/navbar');
        $this->load->view('admin/surat_keterangan_usaha', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
        $this->form_validation->set_rules('tempat_usaha', 'Tempat Usaha', 'required');


        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_usaha_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_usaha/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_keterangan_usaha = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'nama' => $this->input->post('nama'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'suku' => $this->input->post('suku'),
                'alamat' => $this->input->post('alamat'),
                'jenis_usaha' => $this->input->post('jenis_usaha'),
                'tempat_usaha' => $this->input->post('tempat_usaha'),
                'file' => NULL
            );

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_keterangan_usaha['file'] = $file['file_name'];

                $this->db->insert('surat_keterangan_usaha', $surat_keterangan_usaha);
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Usaha berhasil ditambahkan');
                redirect('Surat_Keterangan_Usaha');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Usaha gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Surat_Keterangan_Usaha');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Usaha gagal ditambahkan, cek inputan anda');
            redirect('Surat_Keterangan_Usaha');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_usaha', 'Jenis Usaha', 'required');
        $this->form_validation->set_rules('tempat_usaha', 'Tempat Usaha', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_usaha_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_usaha/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_keterangan_usaha = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'nama' => $this->input->post('nama'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'suku' => $this->input->post('suku'),
            'alamat' => $this->input->post('alamat'),
            'jenis_usaha' => $this->input->post('jenis_usaha'),
            'tempat_usaha' => $this->input->post('tempat_usaha'),
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
                    $data_update_surat_keterangan_usaha['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_keterangan_usaha/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Usaha gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_keterangan_usaha['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_keterangan_usaha', $data_update_surat_keterangan_usaha, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Usaha berhasil diubah');
                redirect('Surat_Keterangan_Usaha');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Usaha gagal diedit, cek inputan anda');
            redirect('Surat_Keterangan_Usaha');
        }
    }

    public function delete_surat()
    {
        $id = $_POST['id'];

        //load data folder
        $data['surat_keterangan_usaha'] = $this->Surat_Keterangan_Usaha_Model->select_data_surat_byId($id)->row();
        $file = $data['surat_keterangan_usaha']->file;

        //hapus file dari folder
        $filehapus = './assets/upload/surat_keterangan_usaha/' . $file;
        unlink($filehapus);

        //hapus data repositori
        $this->Surat_Keterangan_Usaha_Model->delete_surat($id);
    }
}
