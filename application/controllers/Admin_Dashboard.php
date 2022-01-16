<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'User');
        $this->load->model('Data_aktual_model', 'Penjualan');
    }

    public function index()
    {
        $data['title'] = "Dashboard";

        // get all user information from the database
        $username = $this->session->userdata('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
        $user = $this->User->getAllUser();
        $penjualan = $this->Penjualan->getAllPenjualan();
        $data['total_user'] = $this->User->countUser($user);
        $data['total_data'] = $this->Penjualan->countPenjualan($penjualan);
        $data['role'] = $this->session->userdata('role');

        //get data penjualan untuk diagram
        //data aktual penjualan
        $uniq_month = $this->Penjualan->getUniqueMonth();
        $total = array();
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
        }
        $data['total'] = $total;
        $data['prediksi'] = $this->hitung_prediksi($total);
        $data['uniq_month'] = $uniq_month;

        $this->load->view('templates/admin_headbar', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('admin_dashboard/index');
        $this->load->view('templates/admin_footer');
    }

    public function hitung_prediksi($total)
    {
        // data = [
        //     [tahun, bulan, data aktual, prediksi],
        //     [tahun, bulan, data aktual],
        // ]

        //mencari prediksi 3 bulan
        $result = $total;
        for ($i = 0; $i < count($total); $i++) {
            if ($i >= 3) {
                $prediksi = ($total[$i - 1]['total_penjualan'] + $total[$i - 2]['total_penjualan'] + $total[$i - 3]['total_penjualan']) / 3;
                $result[$i]['prediksi'] = $prediksi;
            } else {
                $result[$i]['prediksi'] = Null;
            }
        }

        //mencari mape
        for ($i = 0; $i < count($total); $i++) {
            if ($i >= 3) {
                if ($result[$i]['total_penjualan']) {
                    $mape =  (($result[$i]['total_penjualan'] - $result[$i]['prediksi']) / $result[$i]['total_penjualan']) * 100;
                    $result[$i]['mape'] = $mape;
                } else {
                    $result[$i]['mape'] = null;
                }
            } else {
                $result[$i]['mape'] = null;
            }
        }

        return $result;
    }
}
