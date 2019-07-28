<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcetak_monitoring extends CI_Model {

public function get_cetak_monitoring($no_surat)
	{
		$query = $this->db->query("SELECT * FROM `tb_monev` JOIN tb_ttd_pimpinan ON tb_monev.id_ttd_pimpinan=tb_ttd_pimpinan.id_ttd_pimpinan WHERE tb_monev.no_surat = '$no_surat' GROUP BY tb_monev.no_surat");
		return $query;
	}
public function get_cetak_monitoring2()
	{
		$tanggal_dari = $this->input->post('tanggal_dari');
		$tanggal_sampai = $this->input->post('tanggal_sampai');

		$query = $this->db->query("SELECT * FROM `tb_monev` JOIN tb_ttd_pimpinan ON tb_monev.id_ttd_pimpinan=tb_ttd_pimpinan.id_ttd_pimpinan WHERE tb_monev.tgl_berangkat BETWEEN '$tanggal_dari' AND '$tanggal_sampai' GROUP BY tb_monev.no_surat");
		return $query;
	}

}