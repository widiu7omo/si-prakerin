<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		$this->load->model( 'surat_model' );
		//Do your magic here
	}
	public function index(){
		$data['ttds'] = $this->surat_model->show_ttd();
		$data['jenis_surats'] = $this->surat_model->show_jenis_surat();
		$this->load->view('admin/surat_data',$data);
	}
	public function save_ttd(){
		$surat = $this->surat_model;
		$surat->save_ttd();
		redirect(site_url('surat'));
	}
	public function save_jenis_surat(){
		$surat = $this->surat_model;
		$surat->save_jenis_surat();
		redirect(site_url('surat'));
	}
	public function ttd_remove($id){
		$surat = $this->surat_model;
		$surat->ttd_remove($id);
		redirect(site_url('surat'));
	}
	public function surat_remove($id){
		$surat = $this->surat_model;
		$surat->surat_remove($id);
		redirect(site_url('surat'));
	}
}