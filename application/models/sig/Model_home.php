<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends CI_Model {

  public function tampil_perusahaan($not_id = NULL){
    if ($not_id != NULL) {
      $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
      ->from('tb_perusahaan')
      ->or_like('nama_perusahaan', $not_id)
      ->where('long_perusahaan !=', NULL)
      ->where('lat_perusahaan !=', NULL)
      ->where('status_perusahaan', 'whitelist')
      ->group_by('nama_perusahaan');
    }else{
      $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
      ->from('tb_perusahaan')
      ->order_by('nama_perusahaan', 'ASC')
      ->where('long_perusahaan !=', NULL)
      ->where('lat_perusahaan !=', NULL)
      ->where('status_perusahaan', 'whitelist')
      ->group_by('nama_perusahaan');
    }
    return $query->get();
  }

  public function list_perusahaan($not_id = NULL){
    $query = $this->db->select('id_perusahaan, nama_perusahaan, long_perusahaan, lat_perusahaan')
      ->from('tb_perusahaan')
      ->or_like('nama_perusahaan', $not_id)
      ->where('long_perusahaan !=', NULL)
      ->where('lat_perusahaan !=', NULL)
      ->where('status_perusahaan', 'whitelist')
      ->group_by('nama_perusahaan')
      ->get();
    return $query->result();
  }
}
?>
