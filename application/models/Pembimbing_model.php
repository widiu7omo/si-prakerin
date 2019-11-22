<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing_model extends CI_Model
{

	private $_table = 'tb_dosen_bimbingan_mhs';

	private $_primary_key = 'id_dosen_bimbingan_mhs';

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}

	public function get($id = null, $id_prodi = null)
	{
		return $this->db->get($this->_table)->result();
	}

	public function get_all_with_mhs($id = null)
	{
		$this->db->reset_query();
		$where = null;
		if ($id) {
			$where = array('tb_dosen_bimbingan_mhs.nip_nik' => $id);
		}
		$join = array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join');
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.*', $join);
	}
	public function get_all_pengajuan_judul($id){
		$this->db->reset_query();
		$where = null;
		if ($id) {
			$where = "tb_dosen_bimbingan_mhs.nip_nik = $id AND tb_dosen_bimbingan_mhs.judul_laporan_mhs <> 'NULL'";
		}
		$join = array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join');
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_mahasiswa.nim,tb_dosen_bimbingan_mhs.*', $join);
	}
	public function get_all_pengajuan_sidang($id){
		$this->db->reset_query();
		$where = null;
		if ($id) {
			$where = "tb_dosen_bimbingan_mhs.nip_nik = $id AND tb_dosen_bimbingan_mhs.status_sidang <> 'NULL'";
		}
		$join = array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join');
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_mahasiswa.nim,tb_dosen_bimbingan_mhs.*', $join);
	}
	public function get_mhs_belum_bimbingan($id = null)
	{
		$this->db->reset_query();
		$where = null;
		if ($id) {
			$where = "tb_dosen_bimbingan_mhs.nip_nik = $id AND (tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs NOT IN (SELECT id_dosen_bimbingan_mhs from tb_konsultasi_bimbingan_offline) AND tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs NOT IN (SELECT id_dosen_bimbingan_mhs from tb_konsultasi_bimbingan))";
		}
		$join = array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join');
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.*', $join);
	}

	public function get_mhs_bimbingan_online($id = null)
	{
		$this->db->reset_query();
		$where = null;
		$wherein = null;
		if ($id) {
			$where = array('tb_dosen_bimbingan_mhs.nip_nik' => $id);
			$wherein = array('tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs','select id_dosen_bimbingan_mhs FROM tb_konsultasi_bimbingan');
		}
		$join = array(
			array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join')
		);
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.*,"online" as mode', $join, null, null, $wherein);
	}

	public function get_mhs_bimbingan_offline($id = null,$pdf = null)
	{
		$this->db->reset_query();
		$where = null;
		if ($id) {
			$where = array('tb_dosen_bimbingan_mhs.nip_nik' => $id);
			if($pdf){
				$where['tb_konsultasi_bimbingan_offline.lembar_konsultasi'] = $pdf;
			}
			$wherein = array('tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs', 'select id_dosen_bimbingan_mhs FROM tb_konsultasi_bimbingan_offline');
		}
		$join = array(
			array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join'),
			array('tb_konsultasi_bimbingan_offline', 'tb_konsultasi_bimbingan_offline.id_dosen_bimbingan_mhs = tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs', 'inner join')
		);
		$group = 'tb_mahasiswa.nama_mahasiswa';
		return datajoin($this->_table, $where, 'tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.*,"offline" as mode,tb_konsultasi_bimbingan_offline.lembar_konsultasi', $join, null, null, $wherein, $group);
	}

	public function pengajuan_judul()
	{
		$nim = $this->session->userdata('id');
		$judul = $this->input->post('judul');
		$data = array('judul_laporan_mhs' => $judul,'status_judul'=>NULL);
		$this->db->where(array('nim' => $nim));
		$this->db->set($data);
		return $this->db->update($this->_table);
	}
	public function change_status_seminar($action){
		$nim = $this->input->get('id');
		$data = array('status_seminar' => $action);
		$this->db->where(array('nim' => $nim));
		$this->db->set($data);
		return $this->db->update($this->_table);
	}
	public function change_status_judul($action){
		$nim = $this->input->get('id');
		if($action == 'ulang'){
			$this->insert_history_judul($nim);
		}
		$data = array('status_judul' => $action);
		$this->db->where(array('nim' => $nim));
		$this->db->set($data);
		return $this->db->update($this->_table);
	}
	private function insert_history_judul($nim){
		$data_judul = masterdata('tb_dosen_bimbingan_mhs',"nim = '$nim'",'id_dosen_bimbingan_mhs,judul_laporan_mhs as judul',false);
		if(gettype($data_judul) == 'object'){
			$data_judul->id = 0;
			$this->db->insert('tb_history_judul',$data_judul);
		}
	}
	public function is_has()
	{
		$nim = $this->session->userdata('id');
		$join = array('tb_mahasiswa', 'tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim', 'inner join');
		return datajoin('(select tb_dosen_bimbingan_mhs.*,tb_pegawai.nama_pegawai from tb_dosen_bimbingan_mhs inner join tb_pegawai on tb_dosen_bimbingan_mhs.nip_nik = tb_pegawai.nip_nik)tb_dosen_bimbingan_mhs', array('tb_dosen_bimbingan_mhs.nim' => $nim), 'tb_dosen_bimbingan_mhs.nama_pegawai,tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs,tb_dosen_bimbingan_mhs.judul_laporan_mhs,tb_dosen_bimbingan_mhs.status_judul,tb_dosen_bimbingan_mhs.status_seminar', $join);
	}

	public function replace()
	{
		$post = $this->input->post();
		$tahun_akademik = masterdata('tb_waktu', null, 'id_tahun_akademik');
		$data['id_tahun_akademik'] = $tahun_akademik[0]->id_tahun_akademik;
		$data['id_mhs_pilih_perusahaan'] = $post['id_mhs_pilih_perusahaan'];
		$data['nim'] = $post['nim'];
		$data['nip_nik'] = $post['nip_nik'];
		//add parameter here
		return $this->db->replace($this->_table, $data);
	}

	public function move_bimbingan()
	{
		if (isset($_POST['newDosen']) and isset($_POST['oldDosen'])) {
			$bimbingan_mhs = $this->db->where(array('nim' => $_POST['nim'], 'nip_nik' => $_POST['oldDosen']))->select('id_dosen_bimbingan_mhs as id')->from('tb_dosen_bimbingan_mhs')->get()->result();
			//copy data from konsultasi and drop id_dosen_bimbingan
			$id_old_pembimbing = $bimbingan_mhs[0]->id;
			if (count($bimbingan_mhs) > 0) {
				$this->db->trans_start();
				$this->db->query("create temporary table data_bimbingan_temp 
								select tbk.*,tdb.id_tahun_akademik,tdb.id_mhs_pilih_perusahaan,tdb.nim,tdb.nip_nik,tdb.judul_laporan_mhs 
								from tb_konsultasi_bimbingan tbk inner join tb_dosen_bimbingan_mhs tdb 
								on tdb.id_dosen_bimbingan_mhs = tbk.id_dosen_bimbingan_mhs 
								where tdb.id_dosen_bimbingan_mhs = '$id_old_pembimbing'");
				$this->db->query("alter table data_bimbingan_temp drop column id_dosen_bimbingan_mhs");
				//delete data bimbingan with old dosen
				$this->db->query("delete from tb_konsultasi_bimbingan where id_dosen_bimbingan_mhs = '$id_old_pembimbing'");
				//replace file
				$data_pembimbing = $this->db->select('id_tahun_akademik,id_mhs_pilih_perusahaan,nim,nip_nik,judul_laporan_mhs')
					->from('data_bimbingan_temp')
					->get()->result();
				//replace nip_nik with pembimbing baru
				$data_pembimbing[0]->nip_nik = $_POST['newDosen'];
				$this->db->replace($this->_table, $data_pembimbing[0]);
				$insert_id = $this->db->insert_id();
				$this->db->query("insert into tb_konsultasi_bimbingan (id_dosen_bimbingan_mhs,start,tag,title,masalah,solusi,end,status)
								select '$insert_id' as id_dosen_bimbingan_mhs,start,tag,title,masalah,solusi,end,status from data_bimbingan_temp");
//			$this->db->

				//move data from temp table to konsultasi new
				$this->db->trans_complete();
				return $this->db->trans_status();
			}
			return false;
		}
		return false;
	}

	public function remove_bimbingan()
	{
		if (isset($_POST['newDosen']) and isset($_POST['oldDosen'])) {

		}
		return false;
	}

	public function delete()
	{
		$post = $this->input->post();
		if (isset($post['id'])) {
			$id = $post['id'];
			return $this->db->delete($this->_table, array($this->_primary_key => $id));
		}
		return false;
	}

}

/* End of file changeHere_model.php */
?>
