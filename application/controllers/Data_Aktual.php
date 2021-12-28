<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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

            if (isset($_POST["upload-file"])) {
                $allowedFileType = [
                    'application/vnd.ms-excel',
                    'text/xls',
                    'text/xlsx',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];
                if (in_array($_FILES["upload-file"]["name"], $allowedFileType)) {
                    $targetPath = $_FILES['upload-file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
                    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $spreadSheet = $Reader->load($targetPath);
                    $sheetdata = $spreadSheet->getActiveSheet();
                    $spreadSheetAry = $sheetdata->toArray();
                    $sheetCount = count($spreadSheetAry);

                    if ($sheetCount > 1) {
                        $data = array();
                        for ($i = 1; $i < $sheetCount; $i++) {
                            # code...
                            $tanggal = $sheetdata[$i][1];
                            $penjualan = $sheetdata[$i][2];
                            $data[] = array(
                                'tanggal' => $tanggal,
                                'penjualan' => $penjualan
                            );
                        }
                        $this->Penjualan->insert($data);
                        $this->session->set_flashdata('success_alert', 'User berhasil ditambah!');
                        redirect('data_aktual');
                    }
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
