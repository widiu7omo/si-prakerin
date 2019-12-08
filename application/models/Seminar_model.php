<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar_model extends CI_Model
{
	public function get_tempat_seminar()
	{
		if (isset($_GET['id'])) {
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_tempat')->result();
	}

	public function add_tempat_seminar()
	{
		$post = $this->input->post();
		$data = array('nama' => $post['tempat']);
		return $this->db->insert('tb_seminar_tempat', $data);
	}

	public function update_tempat_seminar()
	{
		$post = $this->input->post();
		$data = array('nama' => $post['tempat']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_tempat', $data, $where);
	}

	public function delete_tempat_seminar()
	{
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_tempat', $where);
	}

	public function get_waktu_seminar()
	{
		if (isset($_GET['id'])) {
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_waktu')->result();
	}

	public function add_waktu_seminar()
	{
		$post = $this->input->post();
		$data = array('jam' => $post['jam']);
		return $this->db->insert('tb_seminar_waktu', $data);
	}

	public function update_waktu_seminar()
	{
		$post = $this->input->post();
		$data = array('jam' => $post['jam']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_waktu', $data, $where);
	}

	public function delete_waktu_seminar()
	{
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_waktu', $where);
	}

	public function get_tanggal_seminar()
	{
		if (isset($_GET['id'])) {
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_tanggal')->result();
	}

	public function add_tanggal_seminar()
	{
		$post = $this->input->post();
		$data = array('hari' => $post['hari'], 'tanggal' => $post['tanggal']);
		return $this->db->insert('tb_seminar_tanggal', $data);
	}

	public function update_tanggal_seminar()
	{
		$post = $this->input->post();
		$data = array('hari' => $post['hari'], 'tanggal' => $post['tanggal']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_tanggal', $data, $where);
	}

	public function delete_tanggal_seminar()
	{
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_tanggal', $where);
	}

	public function add_penguji()
	{
		$post = $this->input->post();
		$data = array('id_dosen' => $post['id'], 'status' => $post['mode']);
		return $this->db->insert('tb_seminar_penguji', $data);
	}

	public function add_bulk_penguji()
	{
		$post = $this->input->post();
		$data = array();
		foreach ($post['ids'] as $id_dosen) {
			array_push($data, array('id_dosen' => $id_dosen, 'status' => $post['mode']));
		}
		return $this->db->insert_batch('tb_seminar_penguji', $data);
	}

	public function delete_bulk_penguji()
	{
		$post = $this->input->post();
		$data = array();
		foreach ($post['ids'] as $id) {
			$where = "id = $id";
			if (!$this->db->delete('tb_seminar_penguji', $where)) {
				return false;
			}
		}
		return true;
	}

	public function get_all_mhs_seminar()
	{
		return $this->db->query("select tm.nama_mahasiswa,tdbm.id_dosen_bimbingan_mhs,tdbm.judul_laporan_mhs from tb_dosen_bimbingan_mhs tdbm INNER JOIN tb_mahasiswa tm on tm.nim = tdbm.nim where tdbm.status_seminar = 'setuju' and tdbm.id_dosen_bimbingan_mhs NOT IN (select id_dosen_bimbingan_mhs from tb_seminar_jadwal)")->result();
	}

	public function get_all_penguji($status)
	{
		$select = 'tb_seminar_penguji.id,tb_pegawai.nama_pegawai,tb_pegawai.nip_nik';
		$join = array(
			array('tb_dosen', 'tb_dosen.id = tb_seminar_penguji.id_dosen', 'INNER'),
			array('tb_pegawai', 'tb_dosen.nip_nik = tb_pegawai.nip_nik', 'INNER')
		);
		$where = "tb_seminar_penguji.status = '$status'";
		return datajoin('tb_seminar_penguji', $where, $select, $join);
	}

	public function delete_penguji()
	{
		$post = $this->input->post();
		$where = array('id' => $post['id']);
		return $this->db->delete('tb_seminar_penguji', $where);
	}

	public function count_tempat()
	{
		return $this->db->query('SELECT COUNT(*) as jumlah FROM tb_seminar_tempat')->row();
	}

	public function count_waktu()
	{
		return $this->db->query('SELECT COUNT(*) as jumlah FROM tb_seminar_waktu')->row();
	}

	public function count_penguji($status)
	{
		return $this->db->query("SELECT COUNT(*) as jumlah FROM tb_seminar_penguji WHERE status = '$status'")->row();
	}

	public function add_jadwal()
	{
		$post = $this->input->post();
		$data = array('id_dosen_bimbingan_mhs' => $post['id_dosen_bimbingan_mhs'],
			'id_seminar_ruangan' => $post['id_seminar_ruangan'],
			'mulai' => $post['mulai'],
			'berakhir' => $post['berakhir'],
			'id_penguji_1' => $post['id_penguji'][0],
			'id_penguji_2' => $post['id_penguji'][1]);
		return $this->db->insert('tb_seminar_jadwal', $data);
	}
	public function update_jadwal()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$data = array('id_dosen_bimbingan_mhs' => $post['id_dosen_bimbingan_mhs'],
			'id_seminar_ruangan' => $post['id_seminar_ruangan'],
			'mulai' => $post['mulai'],
			'berakhir' => $post['berakhir'],
			'id_penguji_1' => $post['id_penguji'][0],
			'id_penguji_2' => $post['id_penguji'][1]);
		return $this->db->update('tb_seminar_jadwal', $data,"id = $id");
	}
	public function delete_jadwal(){
		$post = $this->input->post();
		$id = $post['id'];
		return $this->db->delete('tb_seminar_jadwal',"id=$id");
	}

	public function get_jadwal()
	{
		return $this->db->query("SELECT
    tsj.id,
    tst.id id_tempat,
	tst.nama nama_tempat,
	tm.nama_mahasiswa title,
    tdbm.judul_laporan_mhs laporan,
    tsj.id_dosen_bimbingan_mhs,
	tsj.mulai start,
	tsj.berakhir end,
	tsj.id_penguji_1,
	tsj.id_penguji_2,
    'bg-info' as className,
	tp1.nama_pegawai p1,
	tp2.nama_pegawai p2
FROM
	tb_seminar_jadwal tsj
	INNER JOIN tb_seminar_tempat tst ON tst.id = tsj.id_seminar_ruangan
	INNER JOIN tb_dosen_bimbingan_mhs tdbm ON tsj.id_dosen_bimbingan_mhs = tdbm.id_dosen_bimbingan_mhs
	INNER JOIN tb_mahasiswa tm ON tm.nim = tdbm.nim
	INNER JOIN tb_seminar_penguji penguji_1 ON penguji_1.id = tsj.id_penguji_1
	INNER JOIN tb_seminar_penguji penguji_2 ON penguji_2.id = tsj.id_penguji_2
	INNER JOIN tb_dosen td1 ON td1.id = penguji_1.id_dosen
	INNER JOIN tb_dosen td2 ON td2.id = penguji_2.id_dosen
	INNER JOIN tb_pegawai tp1 ON tp1.nip_nik = td1.nip_nik
	INNER JOIN tb_pegawai tp2 ON tp2.nip_nik = td2.nip_nik")->result();
	}
}
