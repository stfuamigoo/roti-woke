<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_aktual_model extends CI_Model
{
    public function insert($data = array())
    {
        return $this->db->insert('penjualan', $data);
    }

    public function insert_batch($data)
    {
        $this->db->insert_batch('penjualan', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getAllPenjualan()
    {
        return $this->db->query("SELECT * FROM penjualan ")->result_array();
    }

    public function countPenjualan()
    {
        return $this->db->count_all('penjualan');
    }

    public function truncate_data()
    {
        return $this->db->query("TRUNCATE TABLE penjualan");
    }

    public function getUniqueMonth()
    {
        return $this->db->query("SELECT DISTINCT YEAR(tanggal) AS 'tahun', MONTH(tanggal) AS 'bulan' FROM penjualan")->result_array();
    }

    public function getPenjualanByMonth($month)
    {
        return $this->db->query("select * from penjualan where month(tanggal)='$month'")->result_array();
    }

    public function getSumByMonth($month)
    {
        return $this->db->query("select sum(penjualan) as total_penjualan from penjualan where month(tanggal)='$month'")->row_array();
    }

    public function getSumMonthByVarian($month, $varian)
    {
        return $this->db->query("select sum(penjualan) as total_varian from penjualan where month(tanggal)='$month' and varian = '$varian'")->row_array();
    }
}
