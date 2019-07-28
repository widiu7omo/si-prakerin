<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_master_level') != ""){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}		
		$this->load->model('pemonev/Mmonitoring');
		$this->load->model('pemonev/Mkuisioner');
		$this->session->set_userdata('menu', 'kuisioner');
	}
	//index atau halaman login
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_master_level');
		$nip_nik = $this->session->userdata('nip_nik');
		$data['data_monitoring'] = $this->Mmonitoring->get_monitoring($nip_nik);

		$this->load->view('pemonev/tema/head',$data);
		$this->load->view('pemonev/tema/menu');
		$this->load->view('pemonev/kuisioner/kuisioner');
		$this->load->view('pemonev/tema/footer');
	}

	public function isi_kuisioner()
	{
		$data['level'] = $this->session->userdata('nama_master_level');
		$nip_nik = $this->session->userdata('nip_nik');

		$id_perusahaan = $this->input->get('id_perusahaan');
		$data['data_perusahaan'] = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_perusahaan='$id_perusahaan'");

		$data['data_soal_kuesioner'] = $this->Mkuisioner->get_kuisioner($id_perusahaan);

		$this->load->view('pemonev/tema/head',$data);
		$this->load->view('pemonev/tema/menu');
		$this->load->view('pemonev/kuisioner/isi_kuisioner');
		$this->load->view('pemonev/tema/footer');
	}

	//fungsi simpan data
	public function insert_isi_kuisioner()
	{
		$this->Mkuisioner->bacth_insert();
		
		echo '<script language="javascript">alert("Data Berhasil Disimpan!");';
		echo 'document.location="'.site_url('pemonev/Kuisioner').'";</script>';
	}

	public function update_isi_kuisioner()
	{
		$this->Mkuisioner->bacth_update();
		
		echo '<script language="javascript">alert("Data Berhasil Diperbaharui!");';
		echo 'document.location="'.site_url('pemonev/Kuisioner').'";</script>';
	}

	public function isi_kuisioner2()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$nip_nik = $this->session->userdata('nip_nik');
		$id_perusahaan = $this->input->get('id_perusahaan');
		$data['data_perusahaan'] = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_perusahaan='$id_perusahaan'");
		$cek = $this->Mkuisioner->cek($id_perusahaan);

		if($cek->result())
		{
			$data['data_soal_kuesioner'] = $this->Mkuisioner->cek($id_perusahaan);
			echo '<script language="javascript">alert("Data Kuisioner Sudah Diisi!");</script>';
			$this->load->view('pemonev/tema/head',$data);
			$this->load->view('pemonev/tema/menu');
			$this->load->view('pemonev/kuisioner/isi_kuisioner');
			$this->load->view('pemonev/tema/footer');
		}
		else
		{
			$data['data_soal_kuesioner'] = $this->Mkuisioner->get_kuisioner();
			$this->load->view('pemonev/tema/head',$data);
			$this->load->view('pemonev/tema/menu');
			$this->load->view('pemonev/kuisioner/isi_kuisioner2');
			$this->load->view('pemonev/tema/footer');
		}
	}
		
}