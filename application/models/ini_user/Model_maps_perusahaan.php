<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_maps_perusahaan extends CI_Model {
    public function tampil_perusahaan(){
        $query = $this->db->select('id_perusahaan, nama_perusahaan, alamat_perusahaan, telepon_perusahaan, long_perusahaan, lat_perusahaan')
                ->from('tb_perusahaan')
                ->order_by('nama_perusahaan', 'DESC')
                ->where('status_perusahaan', 'whitelist')
                ->group_by('nama_perusahaan')
                ->get();
        return $query->result();
    }

    public function tampil_maps(){
        $query = $this->db->select('id_perusahaan, nama_perusahaan, long_perusahaan, lat_perusahaan')
            ->from('tb_perusahaan')
            ->where('long_perusahaan !=', NULL)
            ->where('lat_perusahaan !=', NULL)
            ->order_by('id_perusahaan', 'DESC')
            ->get();
        return $query->result();
    }
}
?>