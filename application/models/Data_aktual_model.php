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

    //produk
    public function getNamaVarianById()
    {
        return $this->db->query("SELECT penjualan.id, penjualan.tanggal, penjualan.penjualan, produk.nama FROM penjualan INNER JOIN produk ON penjualan.varian=produk.id ORDER BY penjualan.tanggal, produk.nama")->result_array();
    }

    public function getAllVarian()
    {
        return $this->db->query("SELECT * FROM produk ")->result_array();
    }

    public function insertVarian($data = array())
    {
        return $this->db->insert('produk', $data);
    }

    public function deleteVarian($id)
    {
        $query = "DELETE FROM produk WHERE `id` = '$id'";
        return $this->db->query($query);
    }

    public function editVarianData($new_data = array())
    {
        $nama = $new_data['nama'];
        $harga = $new_data['harga'];
        $keterangan = $new_data['keterangan'];
        $id = $new_data['id'];

        $query = "UPDATE produk SET `nama` = '$nama', `harga` = '$harga', `keterangan` = '$keterangan' WHERE `id` = '$id'";
        return $this->db->query($query);
    }

    public function getVarianByID($id)
    {
        return $this->db->query("SELECT * FROM produk WHERE id = '$id'")->row_array();
    }

    public function getAllVarianID()
    {
        return $this->db->query("SELECT id FROM produk ")->result_array();
    }
}
