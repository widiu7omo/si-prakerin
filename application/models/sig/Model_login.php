<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

  public function data_login($username){
    $query = $this->db->select('tb_akun.username, tb_akun.password, tb_mahasiswa.id_program_studi, tb_master_level.nama_master_level')
      ->from('tb_akun')
      ->join('tb_level', 'tb_akun.username = tb_level.username', 'LEFT OUTER')
      ->join('tb_mahasiswa', 'tb_akun.username = tb_mahasiswa.nim', 'LEFT OUTER')
      ->join('tb_master_level', 'tb_level.id_master_level = tb_master_level.id_master_level', 'LEFT OUTER')
      ->where('tb_akun.username', $username)
      ->get();
    return $query->row();
  }

}
?>