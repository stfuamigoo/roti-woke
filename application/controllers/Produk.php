<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'User');
        $this->load->model('Data_aktual_model', 'Penjualan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $username = $this->session->userdata('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['title'] = "Produk";
        $data['role'] = $this->session->userdata('role');
        $data['produk'] = $this->Penjualan->getAllVarian();

        $this->load->view('templates/admin_headbar', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('produk/index');
        $this->load->view('templates/admin_footer');
    }

    public function tambah_produk()
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
            $data['role'] = $this->session->userdata('role');

            $this->form_validation->set_rules('nama', 'nama', 'required|trim', ['required' => 'Nama Varian harus diisi']);
            $this->form_validation->set_rules('harga', 'harga', 'required|trim', ['required' => 'Harga Varian harus diisi']);
            $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim', ['required' => 'Keterangan harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Tambah Varian";
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('produk/tambah_produk');
                $this->load->view('templates/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'harga' => $this->input->post('harga'),
                    'keterangan' => $this->input->post('keterangan')
                ];

                $this->Penjualan->insertVarian($data);

                $this->session->set_flashdata('success_alert', 'Varian berhasil ditambah!');
                redirect('produk');
            }
        }
    }

    public function hapus_produk($id)
    {
        # code...
        $this->Penjualan->deleteVarian($id);
        $this->session->set_flashdata('success_alert', 'Varian berhasil dihapus!');
        redirect('produk');
    }

    public function edit_produk($id)
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
            $data['role'] = $this->session->userdata('role');

            $this->form_validation->set_rules('nama', 'nama', 'required|trim', ['required' => 'Nama Varian harus diisi']);
            $this->form_validation->set_rules('harga', 'harga', 'required|trim', ['required' => 'Harga Varian harus diisi']);
            $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim', ['required' => 'Keterangan harus diisi']);

            if ($this->form_validation->run() == false) {
                $data['title'] = "Edit Varian";
                $data['varian'] = $this->Penjualan->getVarianByID($id);
                $this->load->view('templates/admin_headbar', $data);
                $this->load->view('templates/admin_sidebar');
                $this->load->view('templates/admin_topbar');
                $this->load->view('produk/edit_produk');
                $this->load->view('templates/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'harga' => $this->input->post('harga'),
                    'keterangan' => $this->input->post('keterangan'),
                    'id' => $id
                ];

                $this->Penjualan->editVarianData($data);

                $this->session->set_flashdata('success_alert', 'Varian berhasil diedit!');
                redirect('produk');
            }
        }
    }
}
