<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'User');
        $this->load->model('Data_aktual_model', 'Penjualan');
    }


    public function perhitungan()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }
            $username = $this->session->userdata('username');
            $data['tanggal'] = $this->Penjualan->getAllPenjualan();
            $data['user_data'] = $this->User->getUserByUsername($username);
            $data['title'] = "Perhitungan";

            // $nilai_penjualan = $this->Penjualan->getAllPerhitungan();
            // $nilai_penjualan = array_column($nilai_penjualan, 'nilai');
            $data['tabel1'] = array();

            // if ($nilai_penjualan) {
            // } else {
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('perhitungan/index');
            $this->load->view('templates/admin_footer');
            // }
        }
    }
}
