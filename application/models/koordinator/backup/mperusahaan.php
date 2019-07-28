<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mperusahaan extends CI_Model {


public function get_perusahaan()
	{
		$query = $this->db->query("SELECT * FROM `tb_mhs_pilih_perusahaan`");
		return $query;
	}

public function get_edit_monitoring($id_pengguna)
	{
		$query = $this->db->query("SELECT * FROM pengguna WHERE pengguna.id_pengguna = '$id_pengguna'");
		return $query;
	}

}