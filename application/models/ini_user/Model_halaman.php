<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_halaman extends CI_Model {
    
    public function tampil_halaman($id_halaman = NULL){
        if($id_halaman != null){ 
            $query = $this->db->select('tabel_halaman.id_halaman, tabel_halaman.tanggal_halaman, tabel_halaman.nama_halaman, tabel_halaman.slug_halaman, tabel_halaman.konten_halaman, tabel_kategori.id_kategori, tabel_kategori.nama_kategori')
            ->from('tabel_halaman')
            ->join('tabel_kategori', 'tabel_kategori.id_kategori = tabel_halaman.id_kategori')    
            ->where('id_halaman', $id_halaman)
            ->get();
        }else{
            $query = $this->db->select('tabel_halaman.id_halaman, tabel_halaman.tanggal_halaman, tabel_halaman.nama_halaman, tabel_halaman.slug_halaman, tabel_halaman.konten_halaman, tabel_kategori.nama_kategori')
            ->from('tabel_halaman')
            ->join('tabel_kategori', 'tabel_kategori.id_kategori = tabel_halaman.id_kategori')  
            ->order_by('id_halaman', 'DESC')
            ->get();
        }
        return $query->result();
    }

    public function tampil_kategori(){
        $query = $this->db->select('*')
            ->from('tabel_kategori')
            ->order_by('id_kategori', 'DESC')
            ->get();
        return $query->result();
    }  
    
    public function simpan_halaman($data){
        $query = $this->db->insert('tabel_halaman', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_halaman($data, $id_halaman){
        $query = $this->db->update("tabel_halaman", $data, $id_halaman);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function hapus_halaman($id_halaman){
        $query = $this->db->delete("tabel_halaman", $id_halaman);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>