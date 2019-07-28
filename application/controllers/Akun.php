<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('akun_model');
		//Do your magic here
	}
	public function index()
	{
		$data['pegawais'] = $this->akun_model->getAllAccounts('pegawai');
		$data['mahasiswas'] = $this->akun_model->getAllAccounts('mahasiswa');
		$this->load->view('admin/akun',$data);
	}
	public function management(){
		$get = $this->input->get();
		if ($get['edit']){
			//TODO:doing something here when edit arep press in out.
		}
		$this->load->view('admin/akun_management');
	}
	public function edit(){

	}
	public function hapus_level($id){
		if($this->akun_model->deleteLevel($id)){
			$this->session->set_flashdata( 'status',(object) [
				'status'  => 'success',
				'message' => 'Level akun berhasil dihapus'
			]);
			redirect(site_url('akun'));
		}
		else{
			$this->session->set_flashdata( 'status',(object) [
				'status'  => 'fail',
				'message' => 'Level akun gagal dihapus'
			]);
		}
	}

}

/* End of file Controllername.php */