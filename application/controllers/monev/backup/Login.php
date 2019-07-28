<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('monev/Mlogin');
	}

	//index atau halaman login
	public function index(){
		
		$this->load->view('monev/login');
	}

	//memeriksa hasil inputan di halaman login
	public function proses_login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->Mlogin->cek($username, $password);

		//jika username dan password ada didalam database maka proses pengecekan level akan dijalankan
		if($cek->num_rows() == 1)
		{
			foreach($cek->result() as $data){

				$sess_data['nip_nik'] = $data->nip_nik;
				$sess_data['nama_pegawai'] = $data->nama_pegawai;
				$sess_data['username'] = $data->username;
				$sess_data['password'] = $data->password;
				$sess_data['status'] = strtolower($data->status);

			$this->session->set_userdata($sess_data);
			$level = $this->session->userdata('status');
			$nama = $this->session->userdata('nama_pegawai');
				$this->session->set_userdata('app','simonep');
			}
			if($level == 'koordinator')
			{
				echo '<script language="javascript">alert("Anda Berhasil Login Sebagai Koordinator!");';
				$this->session->set_flashdata('message', 
					'<ol class="alert alert-info alert-dismissible" role="alert">
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <marquee> Selamat Datang '.$nama.', Anda Login Sebagai Koordinator PKL </marquee>
				     </ol>');
				echo 'document.location="'.site_url('koordinator/koordinator').'";</script>';
			}
			elseif($level == 'pemonitoring')
			{
				echo '<script language="javascript">alert("Anda Berhasil Login Sebagai Pemonitoring Perusahaan!");';
				$this->session->set_flashdata('message', 
					'<ol class="alert alert-info alert-dismissible" role="alert">
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        <marquee> Selamat Datang '.$nama.', Anda Login Sebagai Pemonitoring Perusahaan </marquee>
				     </ol>');
				echo 'document.location="'.site_url('pemonev/pemonev').'";</script>';
			}
			else {
				$this->session->set_flashdata('message', 
					'<ol class="alert alert-danger alert-dismissible" role="alert">
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        Username dan Password Tidak Valid!
				    </ol>');
				echo '<script language="javascript">document.location="'.site_url('monev/login').'";</script>';
			}
		}
		//jika username dan password tidak terdapat didalam database
		else
		{
			$this->session->set_flashdata('message', 
					'<ol class="alert alert-danger alert-dismissible" role="alert">
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				        Username dan Password Tidak Valid!
				    </ol>');
			echo '<script language="javascript">document.location="'.site_url('monev/login').'";</script>';
		}

	}
 
 	//fungsi logout dan unsession login
	public function logout(){
		$this->session->sess_destroy();
		echo '<script language="javascript">alert("Anda Berhasil Logout!");';
		echo 'document.location="'.site_url('blog/home').'";</script>';
	}
}
