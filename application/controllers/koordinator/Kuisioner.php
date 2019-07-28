<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Soal Kuisioner
class Kuisioner extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_master_level') != "admin"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}		
		$this->load->model('koordinator/Mkuisioner');

		$this->session->set_userdata('menu', 'kuisioner');
	}

	//fungsi halaman awal kuisioner
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$data['data_soal_kuesioner'] = $this->Mkuisioner->get_kuisioner();

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/kuisioner/kuisioner');
		$this->load->view('koordinator/tema/footer');
	}

	public function edit_kuisioner()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$id_soal_kuisioner  = $this->input->get('id_soal_kuisioner');

		$data['edit_data'] = $this->Mkuisioner->get_edit_kuisioner($id_soal_kuisioner);

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/kuisioner/ubah_kuisioner',$data);
		$this->load->view('koordinator/tema/footer');
	}

	//fungsi simpan data
	public function insert_soal()
	{
		$this->Mkuisioner->insert_kuisioner();
		
		echo '<script language="javascript">alert("Data Berhasil Di Simpan!");';
		echo 'document.location="'.site_url('koordinator/Kuisioner').'";</script>';
	}

	//fungsi hapus data
	public function delete($id_jenis_kuisioner)
	{
		$this->Mkuisioner->delete_kuisioner($id_jenis_kuisioner);
		echo '<script language="javascript">alert("Data Berhasil Di Hapus!");';
		echo 'document.location="'.site_url('koordinator/Kuisioner').'";</script>';
	}
}
