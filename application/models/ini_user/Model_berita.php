<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_berita extends CI_Model {

    public function tampil_berita($id_berita = NULL){
        if($id_berita != null){ 
            $query = $this->db->select('*')
                    ->where('id_berita', $id_berita)
                    ->get('tabel_berita');
        }else{
            $query = $this->db->select('*')
                    ->from('tabel_berita')
                    ->order_by('id_berita', 'DESC')
                    ->get();
        }
        return $query->result();
    } 
    
    public function simpan_berita($data){
        $query = $this->db->insert('tabel_berita', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_berita($data, $id_berita){
        $query = $this->db->update("tabel_berita", $data, $id_berita);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function hapus_berita($id_berita){
        $query = $this->db->delete("tabel_berita", $id_berita);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>