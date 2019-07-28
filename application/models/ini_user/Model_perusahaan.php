<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_perusahaan extends CI_Model {

    public function tampil_perusahaan($id_perusahaan = NULL){
        if ($id_perusahaan != NULL) {
            $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
            ->from('tb_perusahaan')
            ->order_by('id_perusahaan', 'DESC')
            ->where('id_perusahaan', $id_perusahaan)
            ->where('status_perusahaan', 'whitelist')
            ->group_by('nama_perusahaan', 'HAVING count(*) > 0')
            ->get();
        }else {
            $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
            ->from('tb_perusahaan')
            ->order_by('id_perusahaan', 'DESC')
            ->where('status_perusahaan', 'whitelist')
            ->group_by('nama_perusahaan', 'HAVING count(*) > 0')
            ->get();
        }
        return $query->result();
    }

    public function simpan_perusahaan($data){
        $query = $this->db->insert('tb_perusahaan', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function edit_perusahaan($data, $nama_perusahaan){
        $query = $this->db->update("tb_perusahaan", $data, $nama_perusahaan);
        if($query){
            return true;
        }else{
            return false;
        }
      }
    
}
?>