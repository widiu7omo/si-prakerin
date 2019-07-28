<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends CI_Model {

  function popular_post(){
    $query = $this->db->select('*')
      ->from('tabel_berita')
      ->order_by('id_berita', 'DESC')
      ->limit(4)
      ->get();
    return $query->result();
  }

  public function tampil_media_slideshows(){
    $query = $this->db->select('*')
    ->from('tabel_foto')
    ->where('kategori_foto', 'slideshows')
    ->order_by('id_foto', 'DESC')
    ->get();
  return $query->result();
  }

  public function tampil_media(){
    $query = $this->db->select('*')
    ->from('tabel_foto')
    ->where('kategori_foto', 'galeri')
    ->order_by('id_foto', 'DESC')
    ->get();
  return $query->result();
  }
}
?>