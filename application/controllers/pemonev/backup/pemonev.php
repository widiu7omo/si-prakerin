<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemonev extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "pemonitoring"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}
		$this->session->set_userdata('menu', 'beranda');		
	}
	//index atau halaman login
	public function index()
	{
		$data['level'] = $this->session->userdata('status');
		$this->load->view('pemonev/tema/head',$data);
		$this->load->view('pemonev/tema/menu');
		$this->load->view('pemonev/pemonev');
		$this->load->view('pemonev/tema/footer');
	}
}
