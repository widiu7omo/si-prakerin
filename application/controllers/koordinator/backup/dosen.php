<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_status_pkl') != "koordinator"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('login').'";</script>';
		}		
		$this->load->model('koordinator/mdosen');
	}

	//fungsi halaman awal dosen
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_status_pkl');

		$data['data_kuesioner'] = $this->mdosen->get_dosen();

		$data['data_soal_kuesioner'] = $this->db->query("SELECT * FROM `tb_soal_kuisioner");

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/dosen/dosen',$data);
		$this->load->view('koordinator/tema/footer');
	}

	//fungsi simpan data
	public function insert()
	{
		$this->mdosen->insert_dosen();
		
		echo '<script language="javascript">alert("Data Berhasil Di Simpan!");';
		echo 'document.location="'.site_url('koordinator/dosen').'";</script>';
	}
	public function form_google()
	{	
		echo '<script language="javascript">alert("Membuka Google Form");';
		echo 'document.location="'.('https://docs.google.com/forms').'";</script>';
	}

	//fungsi hapus data
	public function delete($id_jenis_kuisioner)
	{
		$this->mdosen->delete_dosen($id_jenis_kuisioner);
		echo '<script language="javascript">alert("Data Berhasil Di Hapus!");';
		echo 'document.location="'.site_url('koordinator/dosen').'";</script>';
	}

	public function insert_kuesioner()
	{
		//var_dump($jawaban);
		$this->mdosen->bacth_insert_kuesioner();
	}
}
