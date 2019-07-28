<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_model extends CI_Model {

	private $_table = 'tb_perusahaan';

	private $_primary_key = 'id_perusahaan';
	public $id_perusahaan;
//	public $id_negara;
//	public $id_provinsi;
//	public $id_kecamatan;
//	public $id_kerjasama_perusahaan;
//	public $id_kab_kota;
//	public $status_perusahaan;
//	public $id_program_studi;
	public $nama_perusahaan;
//	public $alamat_perusahaan;
//	public $telepon_perusahaan;
//	public $long_perusahaan;
//	public $lat_perusahaan;
	public $kuota_pkl;

	//add parameter here

	public function rules(){
		return[
			[
				'field'=>'nama_perusahaan',
				'label'=>'Nama perusahaan',
				'rules'=>'required'
			],
		];
	}

	public function getAll($select = null,$where = null,$join = null,$like = null){
		if($select != null){
			$this->db->select($select);
		}
		if($where != null){
			$this->db->where($where);
		}
		if($join != null){
			$this->db->join($join[0],$join[1],$join[2]);
		}
		if($like != null){
			$this->db->like($like);
		}
		return $this->db->get($this->_table)->result();
	}

	public function getById($id = null,$select = null,$join = null){
		if($select != null){
			$this->db->select($select);
		}
		if($join != null){
			$this->db->join($join[0],$join[1],$join[2]);
		}
		return $this->db->get_where($this->_table,[$this->_primary_key=>$id])->row();
	}
	public function insert_batch(){
		$post = $this->input->post();
		//add parameter here
		$this->id_perusahaan = null;
		$this->nama_perusahaan = $post['nama_perusahaan'];
		//check how many prodi are checked
		if(is_array( $post['id_program_studi'])){
			foreach ($post['id_program_studi'] as $index => $prodi){
				$this->id_program_studi = $prodi;
				$this->status_perusahaan = $post['status_perusahaan'][$index];
				$this->kuota_pkl = $post['kuota_pkl'][$index];
				$this->db->insert($this->_table,$this);
			}
			return true;
		}

		return $this->db->insert($this->_table,$this);
	}
	//insert one perusahaan dari mahasiswa
	public function insert(){

		$post = $this->input->post();
		$prodi = $this->session->userdata('prodi');
		//add parameter here
		//status perusahaan default = uncheck, already declare on db
		$this->id_program_studi = isset($post['id_program_studi'])?$post['id_program_studi']:$prodi;
		$this->nama_perusahaan = $post['nama_perusahaan'];
		$this->alamat_perusahaan = $post['alamat_perusahaan'];
		$this->telepon_perusahaan = $post['telepon_perusahaan'];
		$this->long_perusahaan = $post['long_perusahaan'];
		$this->lat_perusahaan = $post['lat_perusahaan'];
		$this->kuota_pkl = 0;

		return $this->db->insert($this->_table,$this);
	}

	public function update(){
		$post = $this->input->post();

		//add parameter here
		$this->id_perusahaan = $post['id_perusahaan'];
		$this->status_perusahaan = $post['status_perusahaan'];
		$this->nama_perusahaan = $post['nama_perusahaan'];
		$this->kuota_pkl = $post['kuota_pkl'];

		return $this->db->update($this->_table,$this,[$this->_primary_key=>$post['id_perusahaan']]);
	}

	public function delete($id){
		return $this->db->delete($this->_table,[$this->_primary_key=>$id]);
	}

}
/* End of file suffix_model.php */ ?>
