<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar_model extends CI_Model {
	public function get_tempat_seminar(){
		if(isset($_GET['id'])){
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_tempat')->result();
	}
	public function add_tempat_seminar(){
		$post = $this->input->post();
		$data = array('nama'=>$post['tempat']);
		return $this->db->insert('tb_seminar_tempat',$data);
	}
	public function update_tempat_seminar(){
		$post = $this->input->post();
		$data = array('nama'=>$post['tempat']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_tempat',$data,$where);
	}
	public function delete_tempat_seminar(){
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_tempat',$where);
	}
	public function get_waktu_seminar(){
		if(isset($_GET['id'])){
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_waktu')->result();
	}
	public function add_waktu_seminar(){
		$post = $this->input->post();
		$data = array('jam'=>$post['jam']);
		return $this->db->insert('tb_seminar_waktu',$data);
	}
	public function update_waktu_seminar(){
		$post = $this->input->post();
		$data = array('jam'=>$post['jam']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_waktu',$data,$where);
	}
	public function delete_waktu_seminar(){
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_waktu',$where);
	}
	public function get_tanggal_seminar(){
		if(isset($_GET['id'])){
			$where = "id = $_GET[id]";
			$this->db->where($where);
		}
		return $this->db->get('tb_seminar_tanggal')->result();
	}
	public function add_tanggal_seminar(){
		$post = $this->input->post();
		$data = array('hari'=>$post['hari'],'tanggal'=>$post['tanggal']);
		return $this->db->insert('tb_seminar_tanggal',$data);
	}
	public function update_tanggal_seminar(){
		$post = $this->input->post();
		$data = array('hari'=>$post['hari'],'tanggal'=>$post['tanggal']);
		$where = "id = $post[id]";
		return $this->db->update('tb_seminar_tanggal',$data,$where);
	}
	public function delete_tanggal_seminar(){
		$post = $this->input->post();
		$where = "id = $post[id]";
		return $this->db->delete('tb_seminar_tanggal',$where);
	}
	public function add_penguji(){
		$post = $this->input->post();
		$data = array('id_dosen'=>$post['id'],'status'=>$post['mode']);
		return $this->db->insert('tb_seminar_penguji',$data);
	}
	public function add_bulk_penguji(){
		$post = $this->input->post();
		$data = array();
		foreach ($post['ids'] as $id_dosen){
			array_push($data,array('id_dosen'=>$id_dosen,'status'=>$post['mode']));
		}
		return $this->db->insert_batch('tb_seminar_penguji',$data);
	}
	public function delete_bulk_penguji(){
		$post = $this->input->post();
		$data = array();
		foreach ($post['ids'] as $id){
			$where = "id = $id";
			if(!$this->db->delete('tb_seminar_penguji',$where)){
				return false;
			}
		}
		return true;
	}
	public function delete_penguji(){
		$post = $this->input->post();
		$where = array('id'=>$post['id']);
		return $this->db->delete('tb_seminar_penguji',$where);
	}
}
