<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmonitoring extends CI_Model {

public function bacthupdate()
	{

		$no_surat = $this->input->post('no_surat');
		
		$this->db->query("DELETE FROM `tb_monev` WHERE `tb_monev`.`no_surat` = '$no_surat'");

		$nip_nik = $this->input->post('nip_nik');

		$id_dosen_bimbingan_mhs = $this->input->post('id_dosen_bimbingan_mhs');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$id_ttd_pimpinan = $this->input->post('id_ttd_pimpinan');


		$get_tgl_mulai = $this->input->post('tgl_berangkat');
		$tgl_mulai = date("Y-m-d",strtotime($get_tgl_mulai));

		$get_tgl_selesai = $this->input->post('tgl_pulang');
		$tgl_selesai = date("Y-m-d",strtotime($get_tgl_selesai));

		$status = $this->input->post('status');

		$count = count($nip_nik);
		$count2 = count($id_perusahaan);

		if ($count > $count2) {
			for($i = 0; $i<$count; $i++) {
				$entries[] = array(
					'no_surat'=>$no_surat,
					'id_perusahaan'=>$id_perusahaan[$i],
					'tgl_berangkat'=>$tgl_mulai,
					'tgl_pulang'=>$tgl_selesai,
					'nip_nik'=>$nip_nik[$i],
					'id_ttd_pimpinan'=>$id_ttd_pimpinan,
					'status'=>$status,
				);
			};
			$this->db->insert_batch('tb_monev', $entries);
		} else {
			for($i = 0; $i<$count2; $i++) {
				$entries[] = array(
					'no_surat'=>$no_surat,
					'id_perusahaan'=>$id_perusahaan[$i],
					'tgl_berangkat'=>$tgl_mulai,
					'tgl_pulang'=>$tgl_selesai,
					'nip_nik'=>$nip_nik[$i],
					'status'=>$status,
					'id_ttd_pimpinan'=>$id_ttd_pimpinan,
				);
			};
			$this->db->insert_batch('tb_monev', $entries);
		}
	}

public function get_monitoring()
	{
		$query = $this->db->query("SELECT tb_monev.id_monev, tb_ttd_pimpinan.nama_ttd_pimpinan, tb_monev.no_surat, tb_monev.nip_nik, tb_perusahaan.id_perusahaan, tb_monev.tgl_berangkat, tb_monev.tgl_pulang, tb_monev.status FROM tb_monev LEFT JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan JOIN tb_ttd_pimpinan ON tb_ttd_pimpinan.id_ttd_pimpinan = tb_monev.id_ttd_pimpinan GROUP BY tb_monev.no_surat ORDER BY tb_monev.no_surat DESC");
		return $query;
	}

public function get_edit_monitoring($no_surat)
	{
		$query = $this->db->query("SELECT * FROM tb_monev WHERE no_surat = '$no_surat'");
		return $query;
	}

function delete_monitoring($no_surat,$id_perusahaan)
	{
		$query = $this->db->query("DELETE FROM `tb_jawaban_kuisioner` WHERE `tb_jawaban_kuisioner`.`id_perusahaan` = '$id_perusahaan'");
		$query = $this->db->query("DELETE FROM `tb_monev` WHERE `tb_monev`.`no_surat` = '$no_surat'");
		return $query;
	}

function kode_monitoring()
	{
		//query mencek nilai ID maxsimal
		$query = $this->db->query("SELECT max(id_monev) as kode FROM tb_monev");
		//apabila nilai ID tidak sama dengan 0 maka ID akan ditambah 1
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}
		//apabila nilai ID sama dengan 0 maka ID akan di set dengan nilai 1
		else{
			$kode = 1;
		}
		$kodemax = str_pad($kode,3,"000",STR_PAD_LEFT);
		$kodemonitoring = $kodemax;
		return $kodemonitoring;
	}

function no_surat()
	{
		//query mencek nilai ID maxsimal
		$query = $this->db->query("SELECT max(no_surat) as kode FROM tb_monev");
		//apabila nilai ID tidak sama dengan 0 maka ID akan ditambah 1
		if($query->num_rows()<>0){
			$data = $query->row();
			$kode = intval($data->kode)+1;
		}
		//apabila nilai ID sama dengan 0 maka ID akan di set dengan nilai 1
		else{
			$kode = 1;
		}
		$kodemax = str_pad($kode,3,"000",STR_PAD_LEFT);
		$no_surat = $kodemax;
		return $no_surat;
		
	}

public function bacthinsert()
	{

		$no_surat = $this->input->post('no_surat');
		$nip_nik = $this->input->post('nip_nik');

		$id_dosen_bimbingan_mhs = $this->input->post('id_dosen_bimbingan_mhs');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$id_ttd_pimpinan = $this->input->post('id_ttd_pimpinan');

		$get_tgl_mulai = $this->input->post('tgl_berangkat');
		$date1  = date_create($get_tgl_mulai);
		$tgl_mulai = date_format($date1,"Y-m-d");

		$get_tgl_selesai = $this->input->post('tgl_pulang');
		$date2  = date_create($get_tgl_selesai);
		$tgl_selesai = date_format($date2,"Y-m-d");

		$status = 'Proses';

		$count = count($nip_nik);
		$count2 = count($id_perusahaan);

		if ($count > $count2) {
			for($i = 0; $i<$count; $i++) {
				$entries[] = array(
					'no_surat'=>$no_surat,
					'id_perusahaan'=>$id_perusahaan[$i],
					'tgl_berangkat'=>$tgl_mulai,
					'tgl_pulang'=>$tgl_selesai,
					'nip_nik'=>$nip_nik[$i],
					'status'=>$status,
					'id_ttd_pimpinan'=>$id_ttd_pimpinan,
				);
			};
			$this->db->insert_batch('tb_monev', $entries);
		} else {
			for($i = 0; $i<$count2; $i++) {
				$entries[] = array(
					'no_surat'=>$no_surat,
					'id_perusahaan'=>$id_perusahaan[$i],
					'tgl_berangkat'=>$tgl_mulai,
					'tgl_pulang'=>$tgl_selesai,
					'nip_nik'=>$nip_nik[$i],
					'status'=>$status,
					'id_ttd_pimpinan'=>$id_ttd_pimpinan,
				);
			};
			$this->db->insert_batch('tb_monev', $entries);
		}
	}

}
