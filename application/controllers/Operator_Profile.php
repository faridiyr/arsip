<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator_Profile extends CI_Controller
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
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['title'] = 'My Profile';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/my_profile', $data);
        $this->load->view('template/footer');
    }

    public function edit_profile()
    {
        $id = $this->session->userdata('id');

        if (isset($_POST['simpan'])) {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('username', 'Username', 'required|trim');

            //Mengambil filename gambar untuk disimpan
            $nmfile = "file_" . time();
            $config['upload_path'] = './assets/upload/avatar/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '2048'; //kb
            $config['file_name'] = $nmfile;

            $data_update_profile = array(
                'nama' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'file_gambar' => $this->input->post('file_gambar_lama')
            );

            $data['edit_profile'] = $data_update_profile;

            if ($this->form_validation->run() == true) {
                $gbr = NULL;
                $iserror = false;
                if ((!empty($_FILES['file_gambar_baru']['name']))) {
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('file_gambar_baru')) {
                        $gbr = $this->upload->data();
                        $data_update_profile['file_gambar'] = $gbr['file_name'];
                    } else {
                        $this->session->set_flashdata('notification_gagal', 'Akun gagal diubah!');
                        $iserror = true;
                    }
                }
                if (!$iserror) {
                    $this->db->update('user', $data_update_profile, array('id' => $id));
                    $this->session->set_flashdata('notification_berhasil', 'Akun berhasil diubah!');
                    redirect('Operator_Profile');
                }
            } else {
                $this->session->set_flashdata('notification_gagal', 'Akun gagal diubah!');
                redirect('Operator_Profile/edit_profile');
            }
        } else {
            $this->load->model('Auth_Model');
            $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

            $data['title'] = 'Edit Profile';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar_operator');
            $this->load->view('template/navbar');
            $this->load->view('operator/edit_profile', $data);
            $this->load->view('template/footer');
        }
    }
}
