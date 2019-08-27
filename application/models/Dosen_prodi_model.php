<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_prodi_model extends CI_Model {
	private $_table = 'tb_dosen';
	private $_primary_key = 'id';

	public $id;
	public $id_dosen;
	public $id_program_studi;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}
	public function get($id = null,$id_prodi = null,$filter_prodi = null){
		$where = "";
		if($filter_prodi){
			$where .= "tb_dosen.id_program_studi IS NOT NULL AND tb_dosen.id_program_studi <> ''";
		}
		if($id_prodi){
			$where .= " AND tb_dosen.id_program_studi = '$id_prodi'";
		}
		return datajoin($this->_table,$where,'tb_pegawai.*,tb_program_studi.*',array(array('tb_pegawai','tb_pegawai.nip_nik = tb_dosen.nip_nik','RIGHT OUTER'),array('tb_program_studi','tb_program_studi.id_program_studi = tb_dosen.id_program_studi','LEFT OUTER')),null,'nama_pegawai');
	}

	public function insert(){

	}
	public function replace(){
		$data = array('id_program_studi'=>$_POST['prodi'],'nip_nik'=>$_POST['nip']);
		return $this->db->replace('tb_dosen',$data);

	}
	public function update(){

	}

	public function delete($id){
	}

}
/* End of file suffix_model.php */ ?>
