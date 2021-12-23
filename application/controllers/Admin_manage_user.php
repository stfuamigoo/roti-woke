<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_manage_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }

            // get all user information from the database
            $username = $this->session->userdata('username');
            $data['user_data'] = $this->User->getUserByUsername($username);
            $data['users'] = $this->User->getAllUser();
            $data['title'] = "Manage User";

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin_user/index');
            $this->load->view('templates/admin_footer');
        }
    }

    public function tambah_user()
    {
        # code...
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }

            // get all user information from the database
            $username = $this->session->userdata('username');
            $data['user_data'] = $this->User->getUserByUsername($username);

            $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username harus diisi']);
            $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
            $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Telepon harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Admin|Tambah User";
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('admin_user/tambah_user');
                $this->load->view('templates/admin_footer');
            } else {
                $data = [
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'role' => $this->input->post('role'),
                    'alamat' => $this->input->post('alamat'),
                    'telepon' => $this->input->post('telepon')
                ];

                $this->User->insert($data);

                $this->session->set_flashdata('success_alert', 'User berhasil ditambah!');
                redirect('admin_manage_user');
            }
        }
    }

    public function hapus_user($id)
    {
        # code...
        $this->User->deleteUser($id);
        $this->session->set_flashdata('success_alert', 'User berhasil dihapus!');
        redirect('admin_manage_user');
    }

    public function edit_user($id)
    {
        # code...
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }

            // get all user information from the database
            $username = $this->session->userdata('username');
            $data['user_data'] = $this->User->getUserByUsername($username);

            $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username harus diisi']);
            $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat harus diisi']);
            $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim', ['required' => 'Telepon harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Admin|Edit User";
                $data['user'] = $this->User->getUserByID($id);
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('admin_user/edit_user');
                $this->load->view('templates/admin_footer');
            } else {
                $data = [
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'role' => $this->input->post('role'),
                    'alamat' => $this->input->post('alamat'),
                    'telepon' => $this->input->post('telepon'),
                    'id' => $id
                ];

                $this->User->editUserData($data);

                $this->session->set_flashdata('success_alert', 'User berhasil diedit!');
                redirect('admin_manage_user');
            }
        }
    }

    public function accessBlocked()
    {
        $this->load->view('auth/blocked');
    }
}
