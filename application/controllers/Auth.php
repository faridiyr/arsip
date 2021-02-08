<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_Model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('auth/header', $data);
        $this->load->view('auth/login');
        $this->load->view('auth/footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        if ($this->form_validation->run() == true) {
            $user = $this->Auth_Model->cek_user_data($username, $password)->row_array();
            if (isset($user)) {
                $status = true;
            } else {
                $status = false;
            }
            if ($status == true) {
                $data = array(
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'password' => $user['password'],
                    'level' => $user['level'],
                    'file_gambar' => $user['file_gambar'],
                    'login' => true
                );
                if ($data['level'] == 'admin') {
                    $this->session->set_userdata($data);
                    redirect('Dashboard_Admin');
                } else if ($data['level'] == 'operator') {
                    $this->session->set_userdata($data);
                    redirect('Dashboard_Operator');
                }
            } else {
                $this->session->set_flashdata('notification', '<div class="alert alert-danger">Username dan Password tidak ditemukan!</div>');
                redirect('Auth');
            }
        } else {
            $data['title'] = 'Login';
            $this->load->view('auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/footer');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('notification', '<div class="alert alert-info">Logout Success!</div>');
        redirect('Auth');
    }

    public function change_password_admin()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $this->load->library('form_validation');

        $data['password'] = $this->Auth_Model->get_password($id)->row();

        $this->form_validation->set_rules('current_password', 'Old Password', 'required|trim|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|trim|matches[new_password]');

        $data_update_password = array(
            'password' => md5($this->input->post('new_password'))
        );

        if ($this->form_validation->run() == true) {
            if (md5($this->input->post('current_password')) != $this->input->post('password')) {
                $this->session->set_flashdata('notification_gagal', 'Password gagal diubah, Current Password salah!');
                redirect('Auth/change_password_admin');
            } else {
                $this->db->update('user', $data_update_password, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Password berhasil diubah!');
                redirect('Auth/change_password_admin');
            }
        }

        $data['title'] = 'Change Password';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('template/navbar');
        $this->load->view('admin/change_password', $data);
        $this->load->view('template/footer');
    }

    public function change_password_operator()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $this->load->library('form_validation');

        $data['password'] = $this->Auth_Model->get_password($id)->row();

        $this->form_validation->set_rules('current_password', 'Old Password', 'required|trim|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('retype_password', 'Retype Password', 'required|trim|matches[new_password]');

        $data_update_password = array(
            'password' => md5($this->input->post('new_password'))
        );

        if ($this->form_validation->run() == true) {
            if (md5($this->input->post('current_password')) != $this->input->post('password')) {
                $this->session->set_flashdata('notification_gagal', 'Password gagal diubah, Current Password salah!');
                redirect('Auth/change_password_operator');
            } else {
                $this->db->update('user', $data_update_password, array('id' => $id));
                $this->session->set_flashdata('notification_berhasil', 'Password berhasil diubah!');
                redirect('Auth/change_password_operator');
            }
        }

        $data['title'] = 'Change Password';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_operator');
        $this->load->view('template/navbar');
        $this->load->view('operator/change_password', $data);
        $this->load->view('template/footer');
    }
}
