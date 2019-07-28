<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kategori extends CI_Model {
  
  public function tampil_kategori($id_kategori = NULL){
    if($id_kategori != null){ 
      $query = $this->db->select('*')
        ->where($id_kategori)
        ->get('tabel_kategori');
    }else{
      $query = $this->db->select('*')
        ->from('tabel_kategori')
        ->order_by('id_kategori', 'DESC')
        ->get();
    }
    return $query->result();
  }   
  
  public function simpan_kategori($data){
    $query = $this->db->insert('tabel_kategori', $data);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function edit_kategori($data, $id_kategori){
    $query = $this->db->update("tabel_kategori", $data, $id_kategori);
    if($query){
        return true;
    }else{
        return false;
    }
  }

  public function hapus_kategori($id_kategori){
    $query = $this->db->delete("tabel_kategori", $id_kategori);
    if($query){
        return true;
    }else{
        return false;
    }
  }

}
?>