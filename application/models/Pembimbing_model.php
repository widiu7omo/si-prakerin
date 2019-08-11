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
	public function get($id = null,$id_prodi = null)
	{
		return $this->db->get($this->_table)->result();
	}

	public function replace()
	{
		$post = $this->input->post();
		$tahun_akademik = masterdata('tb_waktu',null,'id_tahun_akademik');
		$data['id_tahun_akademik'] =$tahun_akademik[0]->id_tahun_akademik;
		$data['id_mhs_pilih_perusahaan'] = $post['id_mhs_pilih_perusahaan'];
		$data['nim'] = $post['nim'];
		$data['nip_nik'] = $post['nip_nik'];
		//add parameter here
		return $this->db->replace($this->_table, $data);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array($this->_primary_key => $id));
	}

}

/* End of file changeHere_model.php */
?>
