<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_perusahaan extends CI_Model {

  public function tampil_perusahaan($id_perusahaan = NULL){
    if ($id_perusahaan != NULL) {
      $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
      ->from('tb_perusahaan')
      ->order_by('nama_perusahaan', 'ASC')
      ->where('id_perusahaan', $id_perusahaan)
      ->group_by('nama_perusahaan');
    }else{
      $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
      ->from('tb_perusahaan')
      ->order_by('nama_perusahaan', 'ASC')
      ->where('status_perusahaan', 'whitelist')
      ->group_by('nama_perusahaan');
    }
    return $query->get();
  }

  public function tampil_berkas_mhs_pilih_perusahaan($not_id = NULL){
    $query = $this->db->select('tb_berkas_pilih_perusahaan.id_berkas_pilih_perusahaan, tb_berkas_pilih_perusahaan.id_mhs_pilih_perusahaan, tb_berkas_pilih_perusahaan.nama_berkas_pilih_perusahaan, tb_berkas_pilih_perusahaan.jenis_berkas_pilih_perusahaan, tb_mhs_pilih_perusahaan.nim, tb_mhs_pilih_perusahaan.id_perusahaan, tb_perusahaan.nama_perusahaan')
      ->from('tb_berkas_pilih_perusahaan')
      ->join('tb_mhs_pilih_perusahaan', 'tb_mhs_pilih_perusahaan.id_mhs_pilih_perusahaan = tb_berkas_pilih_perusahaan.id_mhs_pilih_perusahaan')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_mhs_pilih_perusahaan.id_perusahaan')
      ->where('tb_perusahaan.nama_perusahaan', $not_id)
      ->order_by('tb_berkas_pilih_perusahaan.id_berkas_pilih_perusahaan', 'DESC');
    return $query->get();
  }

  public function tampil_mhs_review($not_id = NULL){
    $query = $this->db->select('tb_perusahaan.nama_perusahaan, tb_perusahaan_review.id_perusahaan, tb_perusahaan_review.nim, tb_mahasiswa.nama_mahasiswa, tb_perusahaan_review.rating_perusahaan, tb_perusahaan_review.komentar, tb_perusahaan_review.tanggal_review_perusahaan, tb_perusahaan.nama_perusahaan, tb_data_kuisioner.soal_kuisioner')
      ->from('tb_perusahaan_review')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
      ->join('tb_mahasiswa', 'tb_mahasiswa.nim = tb_perusahaan_review.nim')
      ->join('tb_data_kuisioner', 'tb_data_kuisioner.id_data_kuisioner = tb_perusahaan_review.id_data_kuisioner')
      ->or_like('tb_perusahaan.nama_perusahaan', $not_id)
      ->group_by('tb_perusahaan_review.nim')
      ->order_by('tb_perusahaan_review.nim', 'ASC');
    return $query->get();
  }

  public function tampil_perusahaan_review($id = NULL){
    $query = $this->db->select('tb_perusahaan_review.id_perusahaan, tb_perusahaan_review.nim, tb_perusahaan_review.rating_perusahaan, tb_perusahaan_review.komentar, tb_perusahaan_review.tanggal_review_perusahaan, tb_perusahaan.nama_perusahaan, tb_data_kuisioner.soal_kuisioner')
      ->from('tb_perusahaan_review')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
      ->join('tb_data_kuisioner', 'tb_data_kuisioner.id_data_kuisioner = tb_perusahaan_review.id_data_kuisioner')
      ->where('tb_perusahaan_review.nim', $id)
      ->order_by('tb_perusahaan_review.nim', 'ASC');
    return $query->get();
  }

  public function tampil_mhs_berkas_perusahaan($not_id = NULL){
    $query = $this->db->select('*')
    ->from('tb_berkas_pilih_perusahaan')
    ->or_like('jenis_berkas_pilih_perusahaan', $not_id)
    ->get();
  return $query->result();
  }

  public function tampil_jumlah_mhs_review($not_id = NULL){
    $query = $this->db
      ->select('(SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan_review.rating_perusahaan="1" AND tb_perusahaan.nama_perusahaan="'.$not_id.'") as satu,
                (SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan_review.rating_perusahaan="2" AND tb_perusahaan.nama_perusahaan="'.$not_id.'") as dua,
                (SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan_review.rating_perusahaan="3" AND tb_perusahaan.nama_perusahaan="'.$not_id.'") as tiga,
                (SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan_review.rating_perusahaan="4" AND tb_perusahaan.nama_perusahaan="'.$not_id.'") as empat,
                (SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan_review.rating_perusahaan="5" AND tb_perusahaan.nama_perusahaan="'.$not_id.'") as lima,
                (SELECT COUNT(tb_perusahaan_review.rating_perusahaan) FROM tb_perusahaan_review JOIN tb_perusahaan ON tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan WHERE tb_perusahaan.nama_perusahaan="'.$not_id.'") as jumlah')
      ->from('tb_perusahaan_review')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
      ->where('tb_perusahaan.nama_perusahaan', $not_id)
      ->group_by('tb_perusahaan.nama_perusahaan');
    return $query->get();
  }
}
?>
