<?php

use phpDocumentor\Reflection\Types\Null_;

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
            $data['user_data'] = $this->User->getUserByUsername($username);
            $data['title'] = "Perhitungan";
            $data['role'] = $this->session->userdata('role');


            //data aktual penjualan
            $uniq_month = $this->Penjualan->getUniqueMonth();
            $periode = $this->input->get('periode');
            $total = array();
            $total_varian = array();
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

                $varian_pizza_mini = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 'pizza mini');
                $varian_kopi = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 'kopi');
                $varian_sosis = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], 'sosis');
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
            $data['prediksi'] = $this->hitung_prediksi($total, $periode);
            $data['statement'] = $this->hitung_statement($total);
            $data['mape'] = $this->hitung_mape($data['prediksi'], $periode);

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('perhitungan/index');
            $this->load->view('templates/admin_footer');
        }
    }

    public function hitung_prediksi($total, $periode)
    {
        // data = [
        //     [tahun, bulan, data aktual, prediksi],
        //     [tahun, bulan, data aktual],
        // ]

        //mencari prediksi $periode bulan
        $result = $total;
        for ($i = 0; $i < count($total); $i++) {
            if ($i >= $periode && $periode != 0) {
                $prediksi = 0;
                for ($j = 1; $j <= $periode; $j++) {
                    $prediksi += $total[$i - $j]['total_penjualan'];
                }
                $prediksi = $prediksi / $periode;
                $result[$i]['prediksi'] = round(abs($prediksi));
            } else {
                $result[$i]['prediksi'] = Null;
            }
        }


        //mencari error
        for ($i = 0; $i < count($total); $i++) {
            if ($i >= $periode && $periode != 0) {
                if ($result[$i]['total_penjualan']) {
                    $mape =  (($result[$i]['total_penjualan'] - $result[$i]['prediksi']) / $result[$i]['total_penjualan']) * 100;
                    $result[$i]['error'] = round($mape, 2);
                    $result[$i]['mape'] = round(abs($mape), 2);
                } else {
                    $result[$i]['mape'] = null;
                    $result[$i]['error'] = null;
                }
            } else {
                $result[$i]['error'] = null;
                $result[$i]['mape'] = null;
            }
        }

        return $result;
    }

    public function varian()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('user_auth');
        } else {
            if ($this->session->userdata('user_role') == 3) {
                redirect('home');
            }
            $username = $this->session->userdata('username');
            $data['user_data'] = $this->User->getUserByUsername($username);
            $data['title'] = "Perhitungan";
            $data['role'] = $this->session->userdata('role');

            $nama_varian = $this->input->get('nama_varian');
            $periode = $this->input->get('periode');
            //data aktual penjualan
            $uniq_month = $this->Penjualan->getUniqueMonth();
            $total = array();
            $total_varian = array();
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

                $varian = $this->Penjualan->getSumMonthByVarian($uniq['bulan'], $nama_varian);
                $row_varian = [
                    'tahun' => $uniq['tahun'],
                    'bulan' => $monthName,
                    'total_penjualan' => $varian['total_varian']
                ];
                array_push($total_varian, $row_varian);
            }
            $data['uniq_month'] = $uniq_month;
            $data['total'] = $total;
            $data['total_varian'] = $total_varian;
            $data['prediksi'] = $this->hitung_prediksi($total_varian, $periode);
            $data['statement'] = $this->hitung_statement($total_varian);
            $data['selected_varian'] = $nama_varian;
            $data['mape'] = $this->hitung_mape($data['prediksi'], $periode);

            $this->load->view('templates/admin_headbar', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('templates/admin_topbar');
            $this->load->view('perhitungan/varian');
            $this->load->view('templates/admin_footer');
        }
    }

    public function hitung_statement($total)
    {
        if (!$total) {
        } else {
            $countTotal = count($total);
            return round(($total[$countTotal - 1]['total_penjualan'] + $total[$countTotal - 2]['total_penjualan'] + $total[$countTotal - 3]['total_penjualan']) / 3);
        }
    }

    public function hitung_mape($prediksi, $periode)
    {
        if (!$prediksi) {
        } else {
            $total_error = 0;
            for ($i = 0; $i < count($prediksi); $i++) {
                $total_error += $prediksi[$i]['mape'];
            }
            $mape = $total_error / (count($prediksi) - $periode);
            return $mape;
        }
    }
}
