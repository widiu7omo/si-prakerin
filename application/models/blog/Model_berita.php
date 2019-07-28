<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_berita extends CI_Model {

    public function tampil_berita($slug_berita = NULL){
        if($slug_berita != NULL){ 
            $query = $this->db->select('*')
                    ->where('slug_berita', $slug_berita)
                    ->get('tabel_berita');
        }else{
            $query = $this->db->select('*')
                    ->from('tabel_berita')
                    ->order_by('id_berita', 'DESC')
                    ->get();
        }
        return $query;
    } 

    function popular_post_berita(){
        $query = $this->db->select('*')
            ->from('tabel_berita')
            ->order_by('id_berita', 'DESC')
            ->limit(6)
            ->get();
        return $query->result();
    }
}
?>