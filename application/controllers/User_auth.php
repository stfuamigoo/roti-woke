<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if ($this->session->userdata('loggedIn')) {
            redirect('user_auth/accessBlocked');
        }

        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Email harus diisi'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus diisi']);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Halaman Login";
            $this->load->view('auth/index', $data);
        } else {
            // validation success
            $this->_login();
        }
    }

    private function _login()
    {
        // get login form input ($_POST) 
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // get all user information from the database
        $user = $this->User->getUserByUsername($username);

        // check wether user is existed or not
        if ($user) {
            if ($password == $user['password']) {
                $data = [
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set_userdata($data);
                $this->session->set_userdata('loggedIn', true);

                if ($user['role'] == "admin") {
                    redirect('Admin_dashboard');
                }
            } else {
                $this->session->set_flashdata('danger_alert', 'Password salah!');
                redirect('user_auth');
            }
        } else {
            $this->session->set_flashdata('danger_alert', 'User tidak ada');
            redirect('user_auth');
        }
    }

    public function logout()
    {
        // Remove token and user data from the session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('loggedIn');

        $this->session->set_flashdata('success_alert', 'Anda telah keluar!');
        redirect('user_auth');
    }

    public function accessBlocked()
    {
        $this->load->view('auth/blocked');
    }
}
