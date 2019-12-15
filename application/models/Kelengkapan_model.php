<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelengkapan_model extends CI_Model
{

	private $_table = "tb_konsultasi_bimbingan";
	private $_primary_key = "id_konsultasi_bimbingan";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}
	public function upload_berkas(){

	}
}
