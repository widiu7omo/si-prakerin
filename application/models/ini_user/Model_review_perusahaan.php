<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_review_perusahaan extends CI_Model {
  
  public function review_perusahaan($id_perusahaan = NULL){
    if($id_perusahaan != NULL){ 
      $query = $this->db->select('*')
        ->where($id_kategori)
        ->get('tabel_kategori');
    }else{
      $query = $this->db->select('tb_perusahaan.id_perusahaan, tb_perusahaan.nama_perusahaan, round(AVG(tb_perusahaan_review.rating_perusahaan),1) as rata_rata')
        ->from('tb_perusahaan_review')
        ->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_perusahaan_review.id_perusahaan')
        ->group_by('tb_perusahaan.nama_perusahaan')
        ->get();
    }
    return $query;
  }   

}
?>