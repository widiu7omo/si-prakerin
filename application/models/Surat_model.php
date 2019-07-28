<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Surat_model extends CI_Model {

	public function show_ttd(){
		return $this->db->get('tb_ttd_pimpinan')->result();
	}
	public function show_jenis_surat(){
		return $this->db->get('tb_jenis_surat')->result();
	}
	public function save_jenis_surat(){
		$post = $this->input->post();
		$data = array(
			'nama_jenis_surat'=>$post['jenis_surat'],
			'suffix_no_surat'=>$post['no_surat']
		);
		return $this->db->insert('tb_jenis_surat',$data);
	}
	public function save_ttd(){
		$post = $this->input->post();
		$data = array(
			'nip_nik_ttd_pimpinan'=>$post['nip'],
			'nama_ttd_pimpinan'=>$post['nama_pegawai'],
			'jabatan_ttd_pimpinan'=>$post['jabatan']
		);
		return $this->db->insert('tb_ttd_pimpinan',$data);
	}
	public function ttd_remove($id){
		$this->db->where('id_ttd_pimpinan',$id);
		return $this->db->delete( 'tb_ttd_pimpinan' );
	}
	public function surat_remove($id){
		$this->db->where('id_jenis_surat',$id);
		return $this->db->delete('tb_jenis_surat');
	}

}

/* End of file suffix_model.php */ ?>