<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model{

	function cek($username, $password){

		$query = $this->db->query("SELECT tb_akun.password, tb_akun.username, tb_pegawai.status, tb_pegawai.nip_nik, tb_pegawai.nama_pegawai, tb_master_level.nama_master_level FROM tb_akun LEFT OUTER JOIN tb_pegawai ON tb_akun.username = tb_pegawai.username LEFT OUTER JOIN tb_level ON tb_akun.username=tb_level.username LEFT OUTER JOIN tb_master_level ON tb_level.id_master_level=tb_master_level.id_master_level WHERE tb_akun.password ='$password' AND tb_akun.username = '$username'");

		return $query;
	}	
}