<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkuisioner2 extends CI_Model {

public function bacth_insert()
	{
		$nip_nik = $this->input->post('nip_nik');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$id_data_kuisioner = $this->input->post('id_data_kuisioner');
		$jawaban = $this->input->post('jawaban');

		$status = 'Selesai';

		$count = count($id_data_kuisioner);

		for($i = 0; $i<$count; $i++) {
			$entries[] = array(
				'nip_nik'=>$nip_nik,
				'id_perusahaan'=>$id_perusahaan,
				'id_data_kuisioner'=>$id_data_kuisioner[$i],
				'jawaban'=>$jawaban[$i],
			);
		};
		$this->db->insert_batch('tb_jawaban_kuisioner', $entries);
		$this->db->query("UPDATE `tb_monev` SET `status` = '$status' WHERE `tb_monev`.`id_perusahaan` = '$id_perusahaan'");
	}

public function bacth_update()
	{

		$id_jawaban_kuisioner = $this->input->post('id_jawaban_kuisioner');
		$jawaban = $this->input->post('jawaban');

		$count = count($id_jawaban_kuisioner);

		for($i = 0; $i<$count; $i++) {
			$entries[] = array(
				'id_jawaban_kuisioner'=>$id_jawaban_kuisioner[$i],
				'jawaban'=>$jawaban[$i],
			);
		};
		$this->db->update_batch('tb_jawaban_kuisioner', $entries,'id_jawaban_kuisioner');
	}

public function get_monitoring2()
	{
		$query = $this->db->query("SELECT tb_monev.id_monev, tb_monev.no_surat, tb_monev.nip_nik, tb_perusahaan.id_perusahaan, tb_perusahaan.nama_perusahaan, tb_monev.tgl_berangkat, tb_monev.tgl_pulang, tb_monev.status FROM tb_monev JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan");
		return $query;
	}

public function cek($id_perusahaan)
	{
		$query = $this->db->query("SELECT tb_data_kuisioner.id_data_kuisioner, tb_data_kuisioner.soal_kuisioner, tb_jawaban_kuisioner.id_jawaban_kuisioner,tb_jawaban_kuisioner.jawaban, tb_jawaban_kuisioner.id_perusahaan, tb_pegawai.nip_nik, tb_pegawai.nama_pegawai, tb_perusahaan.nama_perusahaan FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner JOIN tb_jawaban_kuisioner ON tb_jawaban_kuisioner.id_data_kuisioner=tb_data_kuisioner.id_data_kuisioner JOIN tb_pegawai ON tb_jawaban_kuisioner.nip_nik=tb_pegawai.nip_nik JOIN tb_perusahaan ON tb_jawaban_kuisioner.id_perusahaan=tb_perusahaan.id_perusahaan WHERE tb_jawaban_kuisioner.id_perusahaan='$id_perusahaan' AND tb_data_kuisioner.id_jenis_kuisioner='11' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

public function get_kuisioner()
	{
		$query = $this->db->query("SELECT * FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner WHERE tb_data_kuisioner.id_jenis_kuisioner='11' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

}