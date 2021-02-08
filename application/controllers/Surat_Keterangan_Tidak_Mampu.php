<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_Keterangan_Tidak_Mampu extends CI_Controller
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

        $this->load->model('Surat_Keterangan_Tidak_Mampu_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_keterangan_tidak_mampu'] = $this->Surat_Keterangan_Tidak_Mampu_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Keterangan Tidak Mampu';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('template/navbar');
        $this->load->view('admin/surat_keterangan_tidak_mampu', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_tidak_mampu_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_tidak_mampu/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_keterangan_tidak_mampu = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'nama' => $this->input->post('nama'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'suku' => $this->input->post('suku'),
                'alamat' => $this->input->post('alamat'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'nama_ayah' => $this->input->post('nama_ayah'),
                'keterangan' => $this->input->post('keterangan'),
                'file' => NULL
            );

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_keterangan_tidak_mampu['file'] = $file['file_name'];

                $this->db->insert('surat_keterangan_tidak_mampu', $surat_keterangan_tidak_mampu);
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Tidak Mampu berhasil ditambahkan');
                redirect('Surat_Keterangan_Tidak_Mampu');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Tidak Mampu gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Surat_Keterangan_Tidak_Mampu');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Tidak Mampu gagal ditambahkan, cek inputan anda');
            redirect('Surat_Keterangan_Tidak_Mampu');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_tidak_mampu_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_tidak_mampu/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_keterangan_tidak_mampu = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'nama' => $this->input->post('nama'),
            'tempat_lahir' => $this->input->post('tempat_lahir'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'suku' => $this->input->post('suku'),
            'alamat' => $this->input->post('alamat'),
            'nama_ibu' => $this->input->post('nama_ibu'),
            'nama_ayah' => $this->input->post('nama_ayah'),
            'keterangan' => $this->input->post('keterangan'),
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
                    $data_update_surat_keterangan_tidak_mampu['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_keterangan_tidak_mampu/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Tidak Mampu gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_keterangan_tidak_mampu['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_keterangan_tidak_mampu', $data_update_surat_keterangan_tidak_mampu, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Tidak Mampu berhasil diubah');
                redirect('Surat_Keterangan_Tidak_Mampu');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Tidak Mampu gagal diedit, cek inputan anda');
            redirect('Surat_Keterangan_Tidak_Mampu');
        }
    }

    public function delete_surat()
    {
        $id = $_POST['id'];

        //load data folder
        $data['surat_keterangan_tidak_mampu'] = $this->Surat_Keterangan_Tidak_Mampu_Model->select_data_surat_byId($id)->row();
        $file = $data['surat_keterangan_tidak_mampu']->file;

        //hapus file dari folder
        $filehapus = './assets/upload/surat_keterangan_tidak_mampu/' . $file;
        unlink($filehapus);

        //hapus data repositori
        $this->Surat_Keterangan_Tidak_Mampu_Model->delete_surat($id);
    }
}
