<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_profile extends CI_Model {
    public function tampil_mahasiswa($nim = NULL){
        $query = $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama_mahasiswa, tb_mahasiswa.alamat_mhs, tb_mahasiswa.jenis_kelamin_mhs, tb_mahasiswa.email_mhs, tb_mahasiswa.tempat_lahir_mhs, tb_mahasiswa.tanggal_lahir_mhs, tb_mahasiswa.no_hp_mahasiswa, tb_program_studi.nama_program_studi')
          ->from('tb_mahasiswa')
          ->join('tb_program_studi', 'tb_mahasiswa.id_program_studi = tb_program_studi.id_program_studi')
          ->where('tb_mahasiswa.nim', $nim)
          ->get();
        return $query->row();
    }
}
?>