<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
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

        $this->load->model('Operator_Model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Auth_Model');
        $id = $this->session->userdata('id');
        $data['user_loged'] = $this->Auth_Model->get_data_user_session($id)->row();

        $data['operator'] = $this->Operator_Model->get_all_operator();

        $data['title'] = 'Kelola Operator';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar_admin');
        $this->load->view('template/navbar');
        $this->load->view('admin/operator', $data);
        $this->load->view('template/footer');
    }

    public function tambah_operator()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array('is_unique' => 'Username already exist, Use an other Username!'));

        if ($this->form_validation->run() == true) {
            $operator = array(
                'nama' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'level' => 'operator',
                'file_gambar' => 'operator.png'
            );
            $data['operator'] = $operator;
            $this->db->insert('user', $operator);
            $this->session->set_flashdata('notification_berhasil', 'Akun Operator berhasil ditambahkan!');
            redirect('Operator');
        } else {
            $this->session->set_flashdata('notification_gagal', 'Operator gagal ditambahkan');
            redirect('Operator');
        }
    }

    public function edit_operator()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Nama', 'required|trim|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array('is_unique' => 'Username already exist, Use an other Username!'));

        $data_update_operator = array(
            'nama' => $this->input->post('name'),
            'username' => $this->input->post('username'),
        );
        $data['operator'] = $data_update_operator;

        $this->db->update('user', $data_update_operator, array('id' => $id));
        $this->session->set_flashdata('notification_berhasil', 'Operator berhasil diubah');
        redirect('Operator');
    }

    public function delete_operator()
    {
        $id = $_POST['id'];

        $this->Operator_Model->delete_operator($id);
    }

    public function reset_password()
    {
        $id = $_POST['id'];

        $this->Operator_Model->reset_password($id);
    }
}
