<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_Aktual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'User');
        $this->load->model('Data_aktual_model', 'Penjualan');
    }

    public function index()
    {
        $this->load->model('User_model', 'User');
        $this->load->model('Data_aktual_model', "Penjualan");
        $data['title'] = "Data Aktual";

        // get all user information from the database
        $username = $this->session->userdata('username');
        $data['data_penjualan'] = $this->Penjualan->getAllPenjualan();
        $data['user_data'] = $this->User->getUserByUsername($username);


        $this->load->view('templates/admin_headbar', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('data_aktual/index');
        $this->load->view('templates/admin_footer');
    }

    public function import_file()
    {
        # code...
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }
            $data['title'] = "Import File";

            // get all user information from the database
            $username = $this->session->userdata('username');
            $data['data_penjualan'] = $this->Penjualan->getAllPenjualan();
            $data['user_data'] = $this->User->getUserByUsername($username);

            // upload file berekstensi excel
            $upload_file = $_FILES['upload_file']['name'];
            $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
            if ($extension == "xls") {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls;
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetdata = $spreadsheet->getActiveSheet()->toArray();
            $sheetcount = count($sheetdata);

            if ($sheetcount > 1) {
                $data = array();
                for ($i = 1; $i < $sheetcount; $i++) {
                    # code...
                    $tanggal = $sheetdata[$i][1];
                    $penjualan = $sheetdata[$i][2];
                    $data[] = array(
                        'tanggal' => $tanggal,
                        'penjualan' => $penjualan
                    );
                }
                $insertdata = $this->Penjualan->insert($data);
                if ($insertdata) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success">Successfully Added.</div>');
                    redirect('index');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data Not upload_fileed. Please Try Again.</div>');
                    redirect('index');
                }
            }

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('data_aktual/upload');
            $this->load->view('templates/admin_footer');
        }
    }
}
