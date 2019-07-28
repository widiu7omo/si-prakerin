<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_master_level') != ""){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}		
		$this->load->model('pemonev/Mmonitoring');
		//$this->load->model('pemonev/Mmahasiswa');

		$this->session->set_userdata('menu', 'monitoring');
	}

	//fungsi halaman awal monitoring
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_master_level');
		$nip_nik = $this->session->userdata('nip_nik');
		$data['data_monitoring'] = $this->Mmonitoring->get_monitoring($nip_nik);

		$this->load->view('pemonev/tema/head',$data);
		$this->load->view('pemonev/tema/menu');
		$this->load->view('pemonev/monitoring/monitoring');
		$this->load->view('pemonev/tema/footer');
	}

	//fungsi memanggil data yang akan di edit
	public function edit()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$no_surat  = $this->input->get('no_surat');
		$data['edit_data'] = $this->Mmonitoring->get_edit_monitoring($no_surat);
		$data['data_mahasiswa'] = $this->Mmahasiswa->get_mahasiswa();;
		$data['data_monev'] = $this->Mmonitoring->get_monitoring();
		$data['data_pemonev'] = $this->db->query("SELECT * FROM `tb_pegawai"); 

		$this->load->view('pemonev/tema/head',$data);
		$this->load->view('pemonev/tema/menu');
		$this->load->view('pemonev/monitoring/ubah_monitoring',$data);
		$this->load->view('pemonev/tema/footer');
	}
	//fungsi memperbaharui data
	public function update()
	{
		$this->Mmonitoring->update_monitoring();
		echo '<script language="javascript">alert("Data Berhasil Di Ubah!");';
		echo 'document.location="'.site_url('pemonev/Monitoring').'";</script>';
	}
}
