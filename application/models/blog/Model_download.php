<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_download extends CI_Model {

  function tampil_download(){
    $query = $this->db->select('*')
      ->from('tabel_file')
      ->order_by('id_file', 'DESC')
      ->get();
    return $query->result();
  }
}
?>