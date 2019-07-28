<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_file extends CI_Model {
  
    public function tampil_file($id_file = NULL){
      if($id_file != null){ 
        $query = $this->db->select('*')
                ->where('id_file', $id_file)
                ->get('tabel_file');
      }else{
        $query = $this->db->select('*')
                ->from('tabel_file')
                ->order_by('id_file', 'DESC')
                ->get();
      }
      return $query->result();
    }   
    
    public function simpan_file($data){
      $query = $this->db->insert('tabel_file', $data);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    public function edit_file($data, $id_file){
      $query = $this->db->update("tabel_file", $data, $id_file);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    public function hapus_file($id_file){
      $query = $this->db->delete("tabel_file", $id_file);
      if($query){
          return true;
      }else{
          return false;
      }
    }

    public function update_status_file($data, $id_file){
      $query = $this->db->update("tabel_file", $data, $id_file);
      if($query){
          return true;
      }else{
          return false;
      }
    }
}
?>