<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi_model extends CI_Model
{

	private $_table = "tb_konsultasi_bimbingan";
	private $_primary_key = "id_konsultasi_bimbingan";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}

	public function get_all_join()
	{
		$join = array('(
				SELECT
					tb_mahasiswa.nama_mahasiswa,
					tb_dosen_bimbingan_mhs.*
				FROM
					tb_mahasiswa
				INNER JOIN tb_dosen_bimbingan_mhs 
				ON tb_mahasiswa.nim = tb_dosen_bimbingan_mhs.nim)
				tb_dosen_bimbingan_mhs',
			'tb_konsultasi_bimbingan.id_dosen_bimbingan_mhs = tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs', 'LEFT OUTER');
		return datajoin($this->_table, null, 'tb_konsultasi_bimbingan.*,
				tb_dosen_bimbingan_mhs.nama_mahasiswa', $join);
	}

	public function show_latest_bimbingan()
	{
		$id = $this->session->userdata('id');
		$where = array('tb_dosen_bimbingan_mhs.nim' => $id);
		$join = array('(select tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.* from tb_dosen_bimbingan_mhs inner join tb_mahasiswa on tb_dosen_bimbingan_mhs.nim = tb_mahasiswa.nim) tb_dosen_bimbingan_mhs', 'tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs = tb_konsultasi_bimbingan.id_dosen_bimbingan_mhs', 'tb_dosen_bimbingan_mhs');
		return datajoin('tb_konsultasi_bimbingan', $where, 'tb_konsultasi_bimbingan.*', $join, null, 'tb_konsultasi_bimbingan.start DESC');
	}
	public function show_all_latest_bimbingan()
	{
		$id = $this->session->userdata('nip_nik');
		$where = array('tb_dosen_bimbingan_mhs.nip_nik' => $id);
		$join = array('(select tb_mahasiswa.nama_mahasiswa,tb_dosen_bimbingan_mhs.* from tb_dosen_bimbingan_mhs inner join tb_mahasiswa on tb_dosen_bimbingan_mhs.nim = tb_mahasiswa.nim) tb_dosen_bimbingan_mhs', 'tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs = tb_konsultasi_bimbingan.id_dosen_bimbingan_mhs', 'tb_dosen_bimbingan_mhs');
		return datajoin('tb_konsultasi_bimbingan', $where, 'tb_konsultasi_bimbingan.*,tb_dosen_bimbingan_mhs.nama_mahasiswa', $join, null, 'tb_konsultasi_bimbingan.start DESC');
	}
	public function check_bimbingan(){
		$nim = $this->session->userdata('id');
		$post = $this->input->post();
		$dosen_bimbingan_mhs = masterdata('tb_dosen_bimbingan_mhs',array('nim'=>$nim),'id_dosen_bimbingan_mhs as id',false);
		if($dosen_bimbingan_mhs){
			//cek mode bimbingan offline || online
			$offline = masterdata('tb_konsultasi_bimbingan_offline',array('id_dosen_bimbingan_mhs'=>$dosen_bimbingan_mhs->id),'lembar_konsultasi as name,"application/pdf" as type, 1234 as size',false);
			$online = masterdata('tb_konsultasi_bimbingan',array('id_dosen_bimbingan_mhs'=>$dosen_bimbingan_mhs->id),'id_konsultasi_bimbingan',false);
			if(!$offline and !$online){
				$result = (object)array('status'=>'success','message'=>'Mahasiswa belum melakukan bimbingan');
			}
			elseif ($offline and !$online){
				$result = $offline;
				$result->mode = 'offline';
				$result->status = 'success';
			}
			elseif (!$offline and $online){
				$result = $online;
				$result->mode = 'online';
				$result->status = 'success';
			}
			else{
				$result = (object)array('status'=>'error','message'=>'Error, both mode are used');
			}
			return $result;
		}
		else{
			return (object)array('status'=>'error','message'=>'Mahasiswa belum mempunyai pembimbing');
		}
	}
	public function remove_bimbingan($file_name){
		$this->db->where(array('lembar_konsultasi'=>$file_name));
		return $this->db->delete('tb_konsultasi_bimbingan_offline');
	}
	public function upload_bimbingan($file_name){
		$nim = $this->session->userdata('id');
		$dosen_bimbingan_mhs = masterdata('tb_dosen_bimbingan_mhs',array('nim'=>$nim),'id_dosen_bimbingan_mhs as id',false);
		if($dosen_bimbingan_mhs){
			$data = array('lembar_konsultasi'=>$file_name,'id_dosen_bimbingan_mhs'=>$dosen_bimbingan_mhs->id);
			return $this->db->replace('tb_konsultasi_bimbingan_offline',$data);
		}
		else{
			return false;
		}
	}
	public function accept()
	{
		$get = $this->input->get();
		if (isset($get['id'])) {
			$this->db->set(array('status' => 'accept'));
			$this->db->where(array($this->_primary_key => $get['id']));
			return $this->db->update($this->_table);
		}
		return false;
	}

	public function decline()
	{
		$get = $this->input->get();
		if (isset($get['id'])) {
			$this->db->set(array('status' => 'reject'));
			$this->db->where(array($this->_primary_key => $get['id']));
			return $this->db->update($this->_table);
		}
		return false;
	}

	public function get()
	{
		$get = $this->input->get();
		$id = isset($get['id'])?$get['id']:null;
		$where = "";
		if ($id) {
			$where = "nim = '$id'";
		}
		$join = array('tb_dosen_bimbingan_mhs','tb_dosen_bimbingan_mhs.id_dosen_bimbingan_mhs = tb_konsultasi_bimbingan.id_dosen_bimbingan_mhs','INNER');
		return datajoin($this->_table, $where, 'tb_konsultasi_bimbingan.*,tb_konsultasi_bimbingan.id_konsultasi_bimbingan as id,tb_konsultasi_bimbingan.tag as className',$join);
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
			'id_dosen_bimbingan_mhs' => $_POST['id_dosen_bimbingan'],
			'masalah' => $_POST['masalah'],
			'solusi' => $_POST['solusi'],
			'tag' => $_POST['tag']);
		$where = array($this->_primary_key => $_POST['id']);
		$this->db->set($data);
		$this->db->where($where);
		if ($this->db->update($this->_table)) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
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
