<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koordinator extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "koordinator"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('login').'";</script>';
		}		
		$this->load->model('koordinator/mkoordinator');
		$this->session->set_userdata('menu', 'koordinator');
	}
	//index atau halaman login
	public function index()
	{
		$data['level'] = $this->session->userdata('status');
		// $data['page'] = 'Halaman Contact';
		// $data['content'] = 'Test';

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/koordinator');
		$this->load->view('koordinator/tema/footer');
	}
}
