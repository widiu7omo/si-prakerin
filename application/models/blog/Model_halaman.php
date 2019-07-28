<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_halaman extends CI_Model {
    public function tampil_halaman($slug_halaman){
        $query = $this->db->select('tabel_halaman.tanggal_halaman, tabel_halaman.nama_halaman, tabel_halaman.slug_halaman, tabel_halaman.konten_halaman, tabel_kategori.nama_kategori, tabel_kategori.slug_kategori')
          ->from('tabel_halaman')
          ->join('tabel_kategori', 'tabel_kategori.id_kategori = tabel_halaman.id_kategori')
          ->where('tabel_halaman.slug_halaman', $slug_halaman)
          ->get();
        return $query;
      } 
}
?>
