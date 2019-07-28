<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "koordinator"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}		
		$this->load->model('koordinator/Mperusahaan');
	}
	//index atau halaman login
	public function index()
	{
		$data['leve'] = $this->session->userdata('status');
		
		$data['data_perusahaan'] = $this->Mperusahaan->get_perusahaan();
		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/perusahaan/perusahaan');
		$this->load->view('koordinator/tema/footer');
	}
}
