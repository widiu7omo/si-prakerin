<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_model extends CI_Model
{

	private $_table = "tb_konsultasi_bimbingan";
	private $_primary_key = "id_konsultasi_bimbingan";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}

	public function insert_kriteria()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_kriteria', $post);
	}

	public function update_kriteria()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_kriteria');
	}

	public function delete_kriteria()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_kriteria');
	}

	public function get_kriteria($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_kriteria.id' => $id]);
		}
		$this->db->join('tb_master_level', 'tb_master_level.id_master_level = tb_kuesioner_kriteria.id_master_level', 'INNER');
		return $this->db->get('tb_kuesioner_kriteria')->result();
	}

	public function insert_pertanyaan()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_pertanyaan', $post);
	}

	public function update_pertanyaan()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_pertanyaan');
	}

	public function delete_pertanyaan()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_pertanyaan');
	}

	public function get_pertanyaan($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_pertanyaan.id' => $id]);
		}
		$this->db->select(['tb_kuesioner_pertanyaan.id','tb_kuesioner_pertanyaan.pertanyaan','tb_kuesioner_kriteria.kriteria','tb_kuesioner_kriteria.id id_kriteria']);
		$this->db->join('tb_kuesioner_kriteria', 'tb_kuesioner_kriteria.id = tb_kuesioner_pertanyaan.id_kriteria', 'INNER');
		return $this->db->get('tb_kuesioner_pertanyaan')->result();
	}

	public function insert_bobot()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_bobot', $post);
	}

	public function update_bobot()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_bobot');
	}

	public function delete_bobot()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_bobot');
	}

	public function get_bobot($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_bobot.id' => $id]);
		}
		$this->db->join('tb_master_level', 'tb_master_level.id_master_level = tb_kuesioner_bobot.id_master_level', 'INNER');
		return $this->db->get('tb_kuesioner_bobot')->result();
	}

}

/* End of file .php */
