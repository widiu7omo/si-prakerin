<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model{

	function cek($username, $password){

		$query = $this->db->query("SELECT tb_akun.password, tb_akun.username, tb_pegawai.status, tb_pegawai.nip_nik, tb_pegawai.nama_pegawai FROM tb_akun JOIN tb_pegawai ON tb_akun.username = tb_pegawai.username WHERE tb_akun.password ='$username' AND tb_akun.username = '$password'");

		return $query;
	}	
}