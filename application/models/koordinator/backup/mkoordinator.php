<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MKoordinator extends CI_Model{

	function cek($username, $password){

		$query = $this->db->query("SELECT * FROM pengguna WHERE username='$username' AND password='$password'");

		return $query;
	}	
}