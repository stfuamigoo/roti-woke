<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_aktual_model extends CI_Model
{
    public function insert($data = array())
    {
        return $this->db->insert('penjualan', $data);
    }

    public function getAllPenjualan()
    {
        return $this->db->query("SELECT * FROM penjualan ")->result_array();
    }

    public function countUser()
    {
        return $this->db->count_all('penjualan');
    }
}
