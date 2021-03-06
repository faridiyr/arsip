<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_Surat_Keterangan_Izin_Kayu extends CI_Controller
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

        $this->load->model('Surat_Keterangan_Izin_Kayu_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['surat_keterangan_izin_kayu'] = $this->Surat_Keterangan_Izin_Kayu_Model->get_all_surat();

        $data['title'] = 'Kelola Surat Keterangan Izin Kayu';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/surat_keterangan_izin_kayu', $data);
        $this->load->view('template/footer');
    }

    public function tambah_surat()
    {
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_izin_kayu_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_izin_kayu/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        if (($this->form_validation->run() == TRUE) && (!empty($_FILES['file']['name']))) {
            $file = NULL;

            $surat_keterangan_izin_kayu = array(
                'nomor' => $this->input->post('nomor'),
                'tanggal' => $this->input->post('tanggal'),
                'nama' => $this->input->post('nama'),
                'suku' => $this->input->post('suku'),
                'jumlah' => $this->input->post('jumlah'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'alamat' => $this->input->post('alamat'),
                'keterangan' => $this->input->post('keterangan'),
                'file' => NULL
            );

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data();
                $surat_keterangan_izin_kayu['file'] = $file['file_name'];

                $this->db->insert('surat_keterangan_izin_kayu', $surat_keterangan_izin_kayu);
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Izin Kayu berhasil ditambahkan');
                redirect('Operator_Surat_Keterangan_Izin_Kayu');
            } else {
                $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Izin Kayu gagal ditambahkan, cek type file dan ukuran file yang anda upload');
                redirect('Operator_Surat_Keterangan_Izin_Kayu');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Surat Keterangan Izin Kayu gagal ditambahkan, cek inputan anda');
            redirect('Operator_Surat_Keterangan_Izin_Kayu');
        }
    }

    public function edit_surat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('suku', 'Suku', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        //Mengambil filename untuk disimpan
        date_default_timezone_set("Asia/Jakarta");
        $nmfile = "surat_keterangan_izin_kayu_" . date("d-m-Y_H-i-s");
        $config['upload_path'] = './assets/upload/surat_keterangan_izin_kayu/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx';
        $config['max_size'] = '2048'; //kb
        $config['file_name'] = $nmfile;

        $data_update_surat_keterangan_izin_kayu = array(
            'nomor' => $this->input->post('nomor'),
            'tanggal' => $this->input->post('tanggal'),
            'nama' => $this->input->post('nama'),
            'suku' => $this->input->post('suku'),
            'jumlah' => $this->input->post('jumlah'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'alamat' => $this->input->post('alamat'),
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
                    $data_update_surat_keterangan_izin_kayu['file'] = $file['file_name'];

                    //hapus file dari folder
                    $filehapus = './assets/upload/surat_keterangan_izin_kayu/' . $data_file_lama;
                    unlink($filehapus);
                } else {
                    $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Izin Kayu gagal diedit');
                    $iserror = true;
                }
            } else {
                $data_update_surat_keterangan_izin_kayu['file'] = $this->input->post('file_lama');
            }
            if (!$iserror) {
                $this->db->update('surat_keterangan_izin_kayu', $data_update_surat_keterangan_izin_kayu, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Surat Keterangan Izin Kayu berhasil diubah');
                redirect('Operator_Surat_Keterangan_Izin_Kayu');
            }
        } else {
            $this->session->set_flashdata('notification_gagal', 'Data Surat Keterangan Izin Kayu gagal diedit, cek inputan anda');
            redirect('Operator_Surat_Keterangan_Izin_Kayu');
        }
    }
}
