<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_master_level') != "admin"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}		
		$this->load->model('koordinator/Mmahasiswa');
		$this->session->set_userdata('menu', 'mahasiswa');
	}
	//index atau halaman login
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_master_level');
		
		$data['data_mahasiswa'] = $this->Mmahasiswa->get_mahasiswa();
		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/mahasiswa/mahasiswa');
		$this->load->view('koordinator/tema/footer');
	}
}
