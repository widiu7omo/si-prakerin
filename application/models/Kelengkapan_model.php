<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelengkapan_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
	}

	public function get_all_pemberkasan()
	{
		$status_mahasiswa = $this->db->query("
		SELECT tm.nim,tm.nama_mahasiswa,
		   IF(nama_file is null,'belum',nama_file) file,
		   IF(tanggal_pemberkasan is null,'belum',tanggal_pemberkasan) tanggal_upload,
		   tsj.mulai tanggal_seminar,
		   tsj.id id_jadwal,
		   tkb.status
		   FROM tb_mahasiswa tm INNER JOIN  tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim
		       INNER JOIN tb_seminar_jadwal tsj on tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs
		       LEFT OUTER JOIN tb_kelengkapan_berkas tkb on tdbm.id_dosen_bimbingan_mhs = tkb.id_dosen_bimbingan_mhs WHERE tkb.id is not null")->result();
		foreach ($status_mahasiswa as $item) {
			$status_rev = $this->get_status_revisi($item->id_jadwal) ?? array();
			if (count($status_rev) > 0) {
				$belum_revisi = array_map(function ($rev) {
					return isset($rev->tanggal_revisi) && $rev->tanggal_revisi != NULL ? 0 : 1;
				}, $status_rev);
				$item->terakhir_revisi = !in_array(1, $belum_revisi) ? $status_rev[0]->tanggal_revisi : "belum revisi";
			} else {
				$item->terakhir_revisi = "belum seminar";
			}
		}
		return $status_mahasiswa;
	}

	public function get_belum_pemberkasan()
	{
		$belum_lengkap = $this->db->query("
		SELECT tm.nim,tm.nama_mahasiswa,
		   IF(nama_file is null,'belum',nama_file) file,
		   IF(tanggal_pemberkasan is null,'belum',tanggal_pemberkasan) tanggal_upload,
		   tsj.mulai tanggal_seminar,
		   tsj.id id_jadwal,
		   tkb.status
		   FROM tb_mahasiswa tm INNER JOIN  tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim
		       INNER JOIN tb_seminar_jadwal tsj on tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs
		       LEFT OUTER JOIN tb_kelengkapan_berkas tkb on tdbm.id_dosen_bimbingan_mhs = tkb.id_dosen_bimbingan_mhs")->result();
		foreach ($belum_lengkap as $item) {
			$status_rev = $this->get_status_revisi($item->id_jadwal) ?? array();
			if (count($status_rev) > 0) {
				$belum_revisi = array_map(function ($rev) {
					return isset($rev->tanggal_revisi) && $rev->tanggal_revisi != NULL ? 0 : 1;
				}, $status_rev);
				$item->terakhir_revisi = !in_array(1, $belum_revisi) ? $status_rev[0]->tanggal_revisi : "belum revisi";
			} else {
				$item->terakhir_revisi = "belum seminar";
			}
		}
		return $belum_lengkap;
	}

	public function get_status_revisi($id)
	{
		return $this->db->query("
		SELECT thsp.tanggal_revisi from tb_seminar_penilaian tsp
			LEFT OUTER JOIN tb_history_seminar_penilaian thsp on tsp.id = thsp.id_seminar_penilaian
			WHERE tsp.id_seminar_jadwal = '$id'
			ORDER BY tanggal_revisi DESC
		")->result();
	}

	public function update_kelengkapan($status, $file)
	{
		$this->db->where("nama_file = '$file'");
		$this->db->set(array('status' => $status));
		return $this->db->update('tb_kelengkapan_berkas');
	}

}
