<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_penilaian_perusahaan()
	{
		$post = $this->input->post();
		$this->db->where('id_dosen_bimbingan_mhs', $post['idbm']);
		if ($this->db->delete('tb_perusahaan_penilaian')) {
			$data = array("nilai_pkl" => $post['tnp'],
				"detail_nilai_pkl" => $post['dnp'],
				"id_dosen_bimbingan_mhs" => $post['idbm']);
			return $this->db->insert('tb_perusahaan_penilaian', $data);
		} else {
			return false;
		}
	}

	public function update_penilaian_perusahaan()
	{
		$post = $this->input->post();

		if ($post['id']) {
			$data = array("nilai_pkl" => $post['tnp'],
				"detail_nilai_pkl" => $post['dnp'],
				"id_dosen_bimbingan_mhs" => $post['idbm']);
			$this->db->set($data);
			$this->db->where("id = '$post[id]'");
			return $this->db->update('tb_perusahaan_penilaian');
		}
	}

	public function delete_penilaian_perusahaan()
	{

	}

	public function get_penilaian_perusahaan($id = null, $detail = false, $filter = false)
	{
		$this->db->reset_query();
		if ($id) {
			$this->db->where($id);
		}
		if ($filter) {
			return $this->db->query('SELECT
				tm.nim,
				tm.nama_mahasiswa,
				tp.nama_pegawai nama_pembimbing,
				0 nilai_pkl,
				"[]" detail_nilai_pkl
			FROM
				 tb_dosen_bimbingan_mhs tdbm
				INNER JOIN tb_pegawai tp ON tdbm.nip_nik = tp.nip_nik
				INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim
				WHERE tdbm.id_dosen_bimbingan_mhs NOT IN (SELECT id_dosen_bimbingan_mhs FROM tb_perusahaan_penilaian)')->result();
		}
		if ($detail) {
			return $this->db->query('SELECT
				tm.nim,
				tm.nama_mahasiswa,
				tp.nama_pegawai nama_pembimbing,
				tpp.nilai_pkl,
				tpp.detail_nilai_pkl
			FROM
				tb_perusahaan_penilaian tpp
				INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tdbm.id_dosen_bimbingan_mhs = tpp.id_dosen_bimbingan_mhs
				INNER JOIN tb_pegawai tp ON tdbm.nip_nik = tp.nip_nik
				INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim')->result();
		}
		return $this->db->select('id,nilai_pkl,detail_nilai_pkl,id_dosen_bimbingan_mhs idbm')->from('tb_perusahaan_penilaian')->get()->result();
	}

	public function get_penilaian_seminar_sementara()
	{
		$post = $this->input->post();
		$id_jadwal = $post['ij'];
		return $this->db->query("SELECT
						tp.nama_pegawai,
						tsp.status_dosen,
       					tsp.nilai_seminar
					FROM
						tb_seminar_penilaian tsp
						INNER JOIN tb_seminar_jadwal tsj ON tsp.id_seminar_jadwal = tsj.id
						INNER JOIN tb_pegawai tp ON tsp.id_dosen = tp.nip_nik
						WHERE tsp.id_seminar_jadwal = '$id_jadwal' AND tsp.status_dosen <> 'p3'")->result();
	}

	public function get_belum_penilaian_seminar()
	{
		return $this->db->query("
			SELECT
				tsj.id ij,
				tp3.nama_pegawai p3,
				tp3.nip_nik,
				tp1.nama_pegawai p1,
				tp1.nip_nik,
				tp2.nama_pegawai p2,
				tp3.nip_nik,
				tdbm.judul_laporan_mhs laporan,
				tst.nama nama_tempat,
				tm.nama_mahasiswa,
				tps.nama_program_studi,
				tm.nim,
				tsj.mulai START,
				tsj.berakhir END
			FROM
				tb_seminar_jadwal tsj
				LEFT OUTER JOIN tb_seminar_tempat tst ON tst.id = tsj.id_seminar_ruangan
				INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tsj.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
				INNER JOIN tb_pegawai tp3 ON tp3.nip_nik = tdbm.nip_nik
				INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim
				INNER JOIN tb_program_studi tps ON tm.id_program_studi = tps.id_program_studi
				INNER JOIN tb_seminar_penguji penguji_1 ON penguji_1.id = tsj.id_penguji_1
				INNER JOIN tb_seminar_penguji penguji_2 ON penguji_2.id = tsj.id_penguji_2
				INNER JOIN tb_dosen td1 ON td1.id = penguji_1.id_dosen
				INNER JOIN tb_dosen td2 ON td2.id = penguji_2.id_dosen
				INNER JOIN tb_pegawai tp1 ON tp1.nip_nik = td1.nip_nik
				INNER JOIN tb_pegawai tp2 ON tp2.nip_nik = td2.nip_nik
			WHERE DATE(tsj.mulai) <= DATE(NOW())
			AND tsj.id NOT IN (select id_seminar_jadwal from tb_seminar_penilaian)
			ORDER BY tsj.mulai
			")->result();
	}

	public function get_status_revisi()
	{
		$jadwal = $this->db->select('id,
		(SELECT nama_mahasiswa FROM tb_mahasiswa tm INNER JOIN tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nama_mahasiswa,
		(SELECT tm.nim FROM tb_mahasiswa tm INNER JOIN tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nim,
	tsj.mulai')->get('tb_seminar_jadwal tsj')->result();
		foreach ($jadwal as $key => $jd) {
			$jd->detail = $this->db->query("SELECT
				tsp.nilai_seminar nilai_1,
				IF(thsp.nilai_seminar is null,'belum',thsp.nilai_seminar) nilai_2,
				IF(thsp.nilai_seminar is null,'belum',thsp.tanggal_revisi) tanggal_revisi,
				(SELECT nama_pegawai from tb_pegawai where nip_nik = tsp.id_dosen) dosen,
				IF(status_dosen = 'p1','Penguji 1',IF(status_dosen = 'p2','Penguji 2','Pembimbing')) status,
				(SELECT nama_mahasiswa FROM tb_mahasiswa tm INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tdbm.nim = tm.nim WHERE id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nama_mahasiswa,
				(SELECT nama_program_studi FROM tb_program_studi tps INNER JOIN tb_mahasiswa tm ON tm.id_program_studi = tps.id_program_studi INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tdbm.nim = tm.nim WHERE id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) program_studi
			FROM
				tb_seminar_penilaian tsp
				LEFT OUTER JOIN tb_history_seminar_penilaian thsp
				ON tsp.id = thsp.id_seminar_penilaian
				INNER JOIN tb_seminar_jadwal tsj
				ON tsj.id = tsp.id_seminar_jadwal
				WHERE tsj.id = '$jd->id'
				")->result();
		}
		return $jadwal;
	}


	public function get_all_rekap()
	{
		$rekap = $this->db->select('
		tsj.id,
       (SELECT nama_mahasiswa
        FROM tb_mahasiswa tm
                 INNER JOIN tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nama_mahasiswa,
       (SELECT tm.nim
        FROM tb_mahasiswa tm
                 INNER JOIN tb_dosen_bimbingan_mhs tdbm on tm.nim = tdbm.nim
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nim,
       (SELECT t.nama_pegawai
        FROM tb_dosen_bimbingan_mhs tdbm
                 INNER JOIN tb_pegawai t on tdbm.nip_nik = t.nip_nik
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) pembimbing,
       (SELECT tdbm.judul_laporan_mhs
        FROM tb_dosen_bimbingan_mhs tdbm
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) judul,
       (SELECT tp.nama_perusahaan
        FROM tb_perusahaan tp
                 INNER JOIN tb_mhs_pilih_perusahaan tmpp ON tp.id_perusahaan = tmpp.id_perusahaan
                 INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tmpp.id_mhs_pilih_perusahaan = tdbm.id_mhs_pilih_perusahaan
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) perusahaan,
        (SELECT tpp.nilai_pkl
        FROM tb_perusahaan_penilaian tpp
                 INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tpp.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nilai_perusahaan,
        (SELECT status FROM tb_kelengkapan_berkas tkb 
        		 INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tkb.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) status_pemberkasan,
        (SELECT tanggal_pemberkasan FROM tb_kelengkapan_berkas tkb 
        		 INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tkb.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
        where tdbm.id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) tanggal_pemberkasan,
       tsj.mulai,
       tsj.berakhir,
       tst.nama tempat,
       p.nama_pegawai penguji_1,
       p2.nama_pegawai penguji_2')->from('tb_seminar_jadwal tsj')
			->join('tb_seminar_tempat tst', 'tsj.id_seminar_ruangan = tst.id', 'INNER')
			->join('tb_seminar_penguji tsp', 'tsj.id_penguji_1 = tsp.id', 'INNER')
			->join('tb_seminar_penguji tsp2', 'tsj.id_penguji_2 = tsp2.id', 'INNER')
			->join('tb_dosen td', 'tsp.id_dosen = td.id', 'INNER')
			->join('tb_dosen td2', 'tsp2.id_dosen = td2.id', 'INNER')
			->join('tb_pegawai p', 'td.nip_nik = p.nip_nik', 'INNER')
			->join('tb_pegawai p2', 'td2.nip_nik = p2.nip_nik', 'INNER')
			->order_by('nim')
			->get()->result();
		foreach ($rekap as $key => $jd) {
			$jd->detail = $this->db->query("SELECT
				tsp.nilai_seminar nilai_1,
				IF(thsp.nilai_seminar is null,'belum',thsp.nilai_seminar) nilai_2,
				IF(thsp.nilai_seminar is null,'belum',thsp.tanggal_revisi) tanggal_revisi,
				(SELECT nama_pegawai from tb_pegawai where nip_nik = tsp.id_dosen) dosen,
				IF(status_dosen = 'p1','Penguji 1',IF(status_dosen = 'p2','Penguji 2','Pembimbing')) status,
				(SELECT nama_mahasiswa FROM tb_mahasiswa tm INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tdbm.nim = tm.nim WHERE id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) nama_mahasiswa,
				(SELECT nama_program_studi FROM tb_program_studi tps INNER JOIN tb_mahasiswa tm ON tm.id_program_studi = tps.id_program_studi INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tdbm.nim = tm.nim WHERE id_dosen_bimbingan_mhs = tsj.id_dosen_bimbingan_mhs) program_studi
			FROM
				tb_seminar_penilaian tsp
				LEFT OUTER JOIN tb_history_seminar_penilaian thsp
				ON tsp.id = thsp.id_seminar_penilaian
				INNER JOIN tb_seminar_jadwal tsj
				ON tsj.id = tsp.id_seminar_jadwal
				WHERE tsj.id = '$jd->id'
				")->result();
		}
		return $rekap;
	}

	public function get_all_penilaian_seminar()
	{
		return $this->db->query("SELECT
			tsj.id ij,
			tp3.nama_pegawai p3,
			tp1.nama_pegawai p1,
			tp2.nama_pegawai p2, (
			SELECT
				IF(thsp.nilai_seminar is null,tsp.nilai_seminar,thsp.nilai_seminar)
			FROM
				tb_seminar_penilaian tsp
			LEFT OUTER JOIN tb_history_seminar_penilaian thsp on tsp.id = thsp.id_seminar_penilaian
			WHERE
			id_seminar_jadwal = ij
			AND id_dosen = tp3.nip_nik LIMIT 1) AS penilaian_pembimbing, (
			SELECT
				IF(thsp.nilai_seminar is null,tsp.nilai_seminar,thsp.nilai_seminar)
			FROM
				tb_seminar_penilaian tsp
			LEFT OUTER JOIN tb_history_seminar_penilaian thsp on tsp.id = thsp.id_seminar_penilaian
			WHERE
			id_seminar_jadwal = ij
			AND id_dosen = tp2.nip_nik LIMIT 1) AS penilaian_penguji2, (
			SELECT
				IF(thsp.nilai_seminar is null,tsp.nilai_seminar,thsp.nilai_seminar)
			FROM
				tb_seminar_penilaian tsp
			LEFT OUTER JOIN tb_history_seminar_penilaian thsp on tsp.id = thsp.id_seminar_penilaian
			WHERE
				id_seminar_jadwal = ij
				AND id_dosen = tp1.nip_nik LIMIT 1) AS penilaian_penguji1, 
       		tdbm.judul_laporan_mhs laporan, 
       		tst.nama nama_tempat, 
       		tm.nama_mahasiswa, 
    		tps.nama_program_studi, 
       		tm.nim, tsj.mulai START, 
       		tsj.berakhir END
			FROM
				tb_seminar_jadwal tsj
				LEFT OUTER JOIN tb_seminar_tempat tst ON tst.id = tsj.id_seminar_ruangan
				INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tsj.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
				INNER JOIN tb_pegawai tp3 ON tp3.nip_nik = tdbm.nip_nik
				INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim
				INNER JOIN tb_program_studi tps ON tm.id_program_studi = tps.id_program_studi
				INNER JOIN tb_seminar_penguji penguji_1 ON penguji_1.id = tsj.id_penguji_1
				INNER JOIN tb_seminar_penguji penguji_2 ON penguji_2.id = tsj.id_penguji_2
				INNER JOIN tb_dosen td1 ON td1.id = penguji_1.id_dosen
				INNER JOIN tb_dosen td2 ON td2.id = penguji_2.id_dosen
				INNER JOIN tb_pegawai tp1 ON tp1.nip_nik = td1.nip_nik
				INNER JOIN tb_pegawai tp2 ON tp2.nip_nik = td2.nip_nik
				LEFT OUTER JOIN tb_seminar_penilaian tsp ON tsp.id_seminar_jadwal = tsj.id
			WHERE
				DATE(tsj.mulai) <= DATE(NOW())
				GROUP BY ij")->result();
	}

	public function get_penilaian_seminar($id = null)
	{
		$where = "";
		if ($id != null) {
			$where .= "WHERE tm.nim = '$id'";
		}
		$where .= "AND tsj.id IN (SELECT id_seminar_jadwal FROM tb_seminar_penilaian)";
		return $this->db->query("
		SELECT
			tsj.id ij,
			tp3.nama_pegawai p3,
			tp1.nama_pegawai p1,
			tp2.nama_pegawai p2,
			tdbm.judul_laporan_mhs laporan,
			tst.nama nama_tempat,
			tm.nama_mahasiswa,
			tsp.nilai_seminar,
			tsp.detail_nilai_seminar,
		    tsp.status_dosen,
			thsp.nilai_seminar nilai_seminar_past,
			thsp.detail_nilai_seminar detail_nilai_seminar_past,
			tps.nama_program_studi,
			tm.nim,
			tsj.mulai START,
			tsj.berakhir END
		FROM
			tb_seminar_jadwal tsj
			INNER JOIN tb_seminar_tempat tst ON tst.id = tsj.id_seminar_ruangan
			INNER JOIN tb_seminar_penilaian tsp ON tsp.id_seminar_jadwal = tsj.id
			LEFT OUTER JOIN tb_history_seminar_penilaian thsp ON thsp.id_seminar_penilaian = tsp.id
			INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tsj.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
			INNER JOIN tb_pegawai tp3 ON tp3.nip_nik = tdbm.nip_nik
			INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim
			INNER JOIN tb_program_studi tps ON tm.id_program_studi = tps.id_program_studi
			INNER JOIN tb_seminar_penguji penguji_1 ON penguji_1.id = tsj.id_penguji_1
			INNER JOIN tb_seminar_penguji penguji_2 ON penguji_2.id = tsj.id_penguji_2
			INNER JOIN tb_dosen td1 ON td1.id = penguji_1.id_dosen
			INNER JOIN tb_dosen td2 ON td2.id = penguji_2.id_dosen
			INNER JOIN tb_pegawai tp1 ON tp1.nip_nik = td1.nip_nik
			INNER JOIN tb_pegawai tp2 ON tp2.nip_nik = td2.nip_nik
		$where
			ORDER BY status_dosen")->result();
	}
}
