<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

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
        $data['data_produk'] = $this->Penjualan->getAllVarianID();
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['role'] = $this->session->userdata('role');

        //tabel penjualan/varian
        $uniq_month = $this->Penjualan->getUniqueMonth();
        $total = array();
        $total_varian = array();
        $id_varian = $data['data_produk'];

        foreach ($uniq_month as $uniq) {
            $sum_month = $this->Penjualan->getSumByMonth($uniq['bulan']);
            $dateObj   = DateTime::createFromFormat('!m', $uniq['bulan']);
            $monthName = $dateObj->format('F');
            $row = [
                'tahun' => $uniq['tahun'],
                'bulan' => $monthName,
                'total_penjualan' => $sum_month['total_penjualan']
            ];
            array_push($total, $row);

            $varian_pizza_mini = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 1);
            $varian_kopi = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 2);
            $varian_sosis = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 3);
            $row_varian = [
                'tahun' => $uniq['tahun'],
                'bulan' => $monthName,
                'pizza_mini' => $varian_pizza_mini['total_varian'],
                'kopi' => $varian_kopi['total_varian'],
                'sosis' => $varian_sosis['total_varian']
            ];
            array_push($total_varian, $row_varian);
        }
        $data['total'] = $total;
        $data['total_varian'] = $total_varian;
        $data['data_fix'] = $this->Penjualan->getNamaVarianById();

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
            $data['role'] = $this->session->userdata('role');

            // upload file berekstensi excel
            $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            if (isset($_FILES['upload-file']['name']) && in_array($_FILES['upload-file']['type'], $file_mimes)) {

                $arr_file = explode('.', $_FILES['upload-file']['name']);
                $extension = end($arr_file);

                if ('csv' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else if ('xls' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $spreadsheet = $reader->load($_FILES['upload-file']['tmp_name']);
                $data_aktual = array();
                for ($j = 0; $j < $spreadsheet->getsheetcount(); $j++) {
                    $sheetData = $spreadsheet->getSheet($j)->toArray();
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $tanggal = $sheetData[$i][0];
                        $penjualan = $sheetData[$i][1];
                        $varian = $sheetData[$i][2];
                        if ($varian == "pizza mini") {
                            $varian = 1;
                        } elseif ($varian == "kopi") {
                            $varian = 2;
                        } else {
                            $varian = 3;
                        }
                        $data_aktual[] = array(
                            'tanggal' => $tanggal,
                            'penjualan' => $penjualan,
                            'varian' => $varian
                        );
                    }
                }
                $return = $this->Penjualan->insert_batch($data_aktual);
                $this->session->set_flashdata('success_alert', 'Data Penjualan berhasil ditambah!');
                redirect('Data_Aktual');
            }
            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('data_aktual/upload');
            $this->load->view('templates/admin_footer');
        }
    }

    public function reset()
    {
        $this->Penjualan->truncate_data();
        $this->session->set_flashdata('success_alert', 'Data Penjualan berhasil direset!');
        redirect('data_aktual');
    }
}
