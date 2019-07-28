<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmonitoring extends CI_Model {


public function get_monitoring($nip_nik)
	{
		$query = $this->db->query("SELECT tb_monev.id_monev, tb_monev.no_surat, tb_monev.nip_nik, tb_perusahaan.id_perusahaan, tb_perusahaan.nama_perusahaan, tb_monev.tgl_berangkat, tb_monev.tgl_pulang, tb_monev.status FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan WHERE tb_monev.nip_nik = '$nip_nik' ORDER BY tb_monev.id_monev DESC");
		return $query;
	}

function update_monitoring()
	{
		$id_monev = $this->input->post('id_monev');
		$no_surat = $this->input->post('no_surat');
		$id_dosen_bimbingan_mhs = $this->input->post('id_dosen_bimbingan_mhs');
		$id_mhs_pilih_perusahaan = $this->input->post('id_mhs_pilih_perusahaan');
		$nip_nik = $this->input->post('nip_nik');

		$get_tgl_mulai = $this->input->post('tgl_berangkat');
		$date1  = date_create($get_tgl_mulai);
		$tgl_mulai = date_format($date1,"Y-m-d");

		$get_tgl_selesai = $this->input->post('tgl_pulang');
		$date2  = date_create($get_tgl_selesai);
		$tgl_selesai = date_format($date2,"Y-m-d");

		$status = $this->input->post('status');
		
		$this->db->query("UPDATE `tb_monev` SET `no_surat` = '$no_surat', `id_dosen_bimbingan_mhs` = '$id_dosen_bimbingan_mhs', `id_mhs_pilih_perusahaan` = NULL, `tgl_berangkat` = '$tgl_mulai', `tgl_pulang` = '$tgl_selesai', `status` = '$status' WHERE `tb_monev`.`id_monev` = '$id_monev';");

	}

}
