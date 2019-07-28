<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kuesioner extends CI_Model {
    
    public function tampil_kuesioner($id_data_kuisioner = NULL){
        if($id_data_kuisioner != null){ 
            $query = $this->db->select('*')
            ->from('tb_data_kuisioner')  
            ->where('id_data_kuisioner', $id_data_kuisioner)
            ->where('id_jenis_kuisioner', '10')
            ->get();
        }else{
            $query = $this->db->select('*')
            ->from('tb_data_kuisioner')
            ->order_by('id_data_kuisioner', 'DESC')
            ->where('id_jenis_kuisioner', '10')
            ->get();
        }
        return $query->result();
    }
    
    public function simpan_kuesioner($data){
        $query = $this->db->insert('tb_data_kuisioner', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_kuesioner($data, $id_data_kuisioner){
        $query = $this->db->update("tb_data_kuisioner", $data, $id_data_kuisioner);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function hapus_kuesioner($id_data_kuisioner){
        $query = $this->db->delete("tb_data_kuisioner", $id_data_kuisioner);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>