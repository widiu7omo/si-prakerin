<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('nama_master_level') != "admin"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('Login').'";</script>';
		}
		//$this->load->helper('tgl_indo');
		$this->load->model('koordinator/Mmonitoring');
		$this->load->model('koordinator/Mmahasiswa');
		$this->session->set_userdata('menu', 'monitoring');
	}

	//fungsi halaman awal monitoring
	public function index()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$data['data_mahasiswa'] = $this->db->query("SELECT tb_perusahaan.nama_perusahaan, tb_perusahaan.id_perusahaan FROM tb_perusahaan JOIN tb_mhs_pilih_perusahaan ON tb_mhs_pilih_perusahaan.id_perusahaan = tb_perusahaan.id_perusahaan WHERE NOT EXISTS (SELECT id_perusahaan FROM tb_monev WHERE tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan) GROUP BY tb_perusahaan.id_perusahaan");

		$data['kode_otomatis'] = $this->Mmonitoring->kode_monitoring();

		$data['data_monev'] = $this->Mmonitoring->get_monitoring();
		
		$data['no_surat'] = $this->Mmonitoring->no_surat();

		$data['data_pemonev'] = $this->db->query("SELECT * FROM `tb_pegawai");

		$data['data_ttd_pimpinan'] = $this->db->query("SELECT * FROM `tb_ttd_pimpinan");

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/monitoring/monitoring');
		$this->load->view('koordinator/tema/footer');
	}

	//fungsi memanggil data yang akan di edit
	public function edit()
	{
		$data['level'] = $this->session->userdata('nama_master_level');

		$no_surat  = $this->input->get('no_surat');

		$data['data_mahasiswa'] = $this->db->query("SELECT tb_perusahaan.nama_perusahaan, tb_perusahaan.id_perusahaan FROM tb_perusahaan JOIN tb_mhs_pilih_perusahaan ON tb_mhs_pilih_perusahaan.id_perusahaan = tb_perusahaan.id_perusahaan WHERE NOT EXISTS (SELECT id_perusahaan FROM tb_monev WHERE tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan) GROUP BY tb_perusahaan.id_perusahaan");

		$data['edit_data'] = $this->Mmonitoring->get_edit_monitoring($no_surat);

		$data['data_perusahaan_pkl'] = $this->Mmahasiswa->get_mahasiswa();

		$data['data_monev'] = $this->Mmonitoring->get_monitoring();

		$data['data_pemonev'] = $this->db->query("SELECT * FROM `tb_pegawai");
		$data['data_ttd_pimpinan'] = $this->db->query("SELECT * FROM `tb_ttd_pimpinan");

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/monitoring/ubah_monitoring');
		$this->load->view('koordinator/tema/footer');
	}

	public function insert2()
	{
		$this->Mmonitoring->bacthinsert();

		// $this->session->set_flashdata('message', 'anda berhasil menginput data');
		echo '<script language="javascript">alert("Data Berhasil Di Simpan!");';
		echo 'document.location="'.site_url('koordinator/Monitoring').'";</script>';
	}

	//fungsi memperbaharui data
	public function update()
	{
		$this->Mmonitoring->bacthupdate();
		echo '<script language="javascript">alert("Data Berhasil Di Ubah!");';
		echo 'document.location="'.site_url('koordinator/Monitoring').'";</script>';
	}

	//fungsi hapus data
	public function delete()
	{
		$no_surat  = $this->input->get('no_surat');
		$id_perusahaan  = $this->input->get('id_perusahaan');

		$this->Mmonitoring->delete_monitoring($no_surat,$id_perusahaan);
		echo '<script language="javascript">alert("Data Berhasil Di Hapus!");';
		echo 'document.location="'.site_url('koordinator/Monitoring').'";</script>';
	}
}
