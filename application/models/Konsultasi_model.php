<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi_model extends CI_Model
{

	private $_table = "tb_konsultasi_bimbingan";
	private $_primary_key = "id_konsultasi_bimbingan";

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get($id = null)
	{
		$where = "";
		if ($id) {
			$where = "$this->_primary_key = '$id'";
		}
		return datajoin($this->_table, $where, 'tb_konsultasi_bimbingan.id_konsultasi_bimbingan as id,tb_konsultasi_bimbingan.*');
	}

	public function insert()
	{

		$data = array(
			'id_dosen_bimbingan_mhs' => $_POST['id_dosen_bimbingan'],
			'start' => $_POST['start'],
			'end' => $_POST['end'],
			'tag' => $_POST['tag'],
			'title' => $_POST['title'],
			'masalah' => $_POST['masalah'],
			'solusi' => isset($_POST['solusi']) ? $_POST['solusi'] : ""
		);
		if ($this->db->insert($this->_table, $data)) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function update()
	{
		$data = array(
			'title' => $_POST['title'],
			'id_dosen_bimbingan_mhs'=>$_POST['id_dosen_bimbingan'],
			'masalah'=>$_POST['masalah'],
			'solusi'=>$_POST['solusi'],
			'tag'=>$_POST['tag']);
		$where = array($this->_primary_key=>$_POST['id']);
		$this->db->set($data);
		$this->db->where($where);
		if($this->db->update($this->_table)){
			echo json_encode(array('status'=>'success'));
			return;
		}
		echo json_encode(array('status'=>'error'));
	}

	public function delete()
	{
		$id = $_POST['id'];
		$where = array($this->_primary_key => $id);
		if ($this->db->delete($this->_table, $where)) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

}

/* End of file .php */
