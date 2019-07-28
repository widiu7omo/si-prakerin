<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_prakerin extends CI_Model {

  public function tampil_mhs_perusahaan($nim = NULL){
    $query = $this->db->select('*, tb_perusahaan.nama_perusahaan')
      ->from('tb_mhs_pilih_perusahaan')
      ->join('tb_mahasiswa', 'tb_mhs_pilih_perusahaan.nim = tb_mahasiswa.nim')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_mhs_pilih_perusahaan.id_perusahaan', 'LEFT')
      ->join('tb_negara', 'tb_negara.id_negara = tb_perusahaan.id_negara', 'LEFT')
      ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_perusahaan.id_provinsi', 'LEFT')
      ->join('tb_kabupaten_kota', 'tb_kabupaten_kota.id_kab_kota = tb_perusahaan.id_kab_kota', 'LEFT')
      ->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_perusahaan.id_kecamatan', 'LEFT')
      ->where('tb_mahasiswa.nim', $nim)
      ->get();
    return $query;
  }

  public function tampil_soal_kuesioner(){
    $query = $this->db->select('*')
    ->from('tb_data_kuisioner')
    ->where('id_jenis_kuisioner', '10')
    ->order_by('id_data_kuisioner', 'ASC')
    ->get();
  return $query->result();
  }

  public function tampil_mhs_review($nim = NULL){
    $query = $this->db->select('tb_perusahaan_review.id_perusahaan_review, tb_perusahaan_review.id_perusahaan, tb_perusahaan_review.nim, tb_perusahaan_review.rating_perusahaan, tb_perusahaan_review.komentar, tb_perusahaan_review.tanggal_review_perusahaan, tb_perusahaan.nama_perusahaan, tb_perusahaan_review.id_data_kuisioner, tb_data_kuisioner.soal_kuisioner')
      ->from('tb_perusahaan_review')
      ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
      ->join('tb_data_kuisioner', 'tb_data_kuisioner.id_data_kuisioner = tb_perusahaan_review.id_data_kuisioner')
      ->where('tb_perusahaan_review.nim', $nim);
    return $query->get();
  }

  public function tampil_mhs_berkas_perusahaan($nim = NULL){
    $query = $this->db->select('*')
    ->from('tb_berkas_pilih_perusahaan')
    ->or_like('jenis_berkas_pilih_perusahaan', $nim);
  return $query->get();
  }

  public function tambah_review_perusahaan($data){
    $query = $this->db->insert("tb_perusahaan_review", $data);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function update_review_perusahaan($data, $id_perusahaan_review){
    $query = $this->db->update("tb_perusahaan_review", $data, $id_perusahaan_review);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function simpan_perusahaan($data, $nama_perusahaan){
    $query = $this->db->update("tb_perusahaan", $data, $nama_perusahaan);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function simpan_foto_perusahaan($data){
    $query = $this->db->insert("tb_berkas_pilih_perusahaan", $data);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function tampil_negara($id = NULL){
    if ($id != NULL){
      $query = $this->db->where('id_negara', $id);
    }
    $query = $this->db->select('id_negara, nama_negara')
      ->from('tb_negara')
      ->order_by('nama_negara')
      ->get();
    return $query->result();
  }

  public function tampil_provinsi($id_negara){
    $query = $this->db->select('tb_provinsi.id_provinsi, tb_provinsi.nama_provinsi, tb_provinsi.id_negara')
      ->from('tb_provinsi')
      ->join('tb_negara', 'tb_negara.id_negara = tb_provinsi.id_negara')
      ->where('tb_provinsi.id_negara', $id_negara)
      ->order_by('nama_provinsi')
      ->get();
    return $query->result();
  }

  public function tampil_kabupaten($id_provinsi){
    $query = $this->db->select('tb_kabupaten_kota.id_kab_kota , tb_kabupaten_kota.nama_kab_kota, tb_provinsi.id_provinsi')
    ->from('tb_kabupaten_kota')
    ->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten_kota.id_provinsi')
    ->where('tb_provinsi.id_provinsi', $id_provinsi)
    ->order_by('nama_kab_kota')
    ->get();
    return $query->result();
  }

  public function tampil_kecamatan($id_kabupaten){
    $query = $this->db->select('tb_kecamatan.id_kecamatan, tb_kabupaten_kota.id_kab_kota, tb_kecamatan.nama_kecamatan')
    ->from('tb_kecamatan')
    ->join('tb_kabupaten_kota', 'tb_kabupaten_kota.id_kab_kota = tb_kecamatan.id_kab_kota')
    ->where('tb_kabupaten_kota.id_kab_kota', $id_kabupaten)
    ->order_by('nama_kecamatan')
    ->get();
    return $query->result();
  }

  public function hapus_foto_perusahaan($id_berkas_pilih_perusahaan){
    $query = $this->db->delete('tb_berkas_pilih_perusahaan', $id_berkas_pilih_perusahaan);
        if($query){
            return true;
        }else{
            return false;
        }
  }
}
?>