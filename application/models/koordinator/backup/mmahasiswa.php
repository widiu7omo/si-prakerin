<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmahasiswa extends CI_Model {


public function get_mahasiswa()
	{
		$query = $this->db->query("SELECT tb_mahasiswa.nim, tb_mhs_pilih_perusahaan.id_mhs_pilih_perusahaan, tb_mahasiswa.nama_mahasiswa, tahun_akademik.tahun_akademik, tb_program_studi.nama_program_studi, tb_perusahaan.nama_perusahaan, tb_perusahaan.id_perusahaan FROM `tb_mahasiswa` JOIN tb_mhs_pilih_perusahaan ON tb_mahasiswa.nim = tb_mhs_pilih_perusahaan.nim JOIN tb_perusahaan ON tb_mhs_pilih_perusahaan.id_perusahaan = tb_perusahaan.id_perusahaan JOIN tahun_akademik ON tb_mahasiswa.id_tahun_akademik = tahun_akademik.id_tahun_akademik JOIN tb_program_studi ON tb_mahasiswa.id_program_studi = tb_program_studi.id_program_studi GROUP BY tb_mhs_pilih_perusahaan.id_perusahaan");
		return $query;
	}

}