<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkuisioner extends CI_Model {

public function insert_kuisioner()
	{
		$id_jenis_kuisioner = $this->input->post('id_jenis_kuisioner');
		$soal_kuisioner = $this->input->post('soal_kuisioner');

		$this->db->query("INSERT INTO `tb_data_kuisioner` (`id_data_kuisioner`, `soal_kuisioner`, `id_jenis_kuisioner`) VALUES (NULL, '$soal_kuisioner', '1');");
	}

public function get_kuisioner()
	{
		$query = $this->db->query("SELECT * FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner WHERE tb_jenis_kuisioner.jenis_kuisioner = 'pemonitoring' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

public function get_edit_kuisioner($id_data_kuisioner)
	{
		$query = $this->db->query("SELECT * FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner WHERE tb_data_kuisioner.id_data_kuisioner='2'");
		return $query;
	}

public function delete_kuisioner($id_jenis_kuisioner)
	{
		$query = $this->db->query("DELETE FROM `tb_data_kuisioner` WHERE `tb_data_kuisioner`.`id_jenis_kuisioner` = '$id_jenis_kuisioner'");
		return $query;
	}

public function bacth_insert_kuesioner()
	{
		$jawaban = $this->input->post('jawaban');

		// var_dump($jawaban);

		$id_jenis_kuisioner = '1';

		$entries = array(
			'id_jenis_kuisioner'=>$id_jenis_kuisioner,
			//'soal_kuisioner'=>$soal_kuisioner,
			'jawaban_kuisioner'=>$jawaban,
		);
		$this->db->insert('tb_data_kuisioner', $entries);
	}

}