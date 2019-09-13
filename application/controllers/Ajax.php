<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

use Tools\Excel;

require APPPATH . 'libraries/Excel.php';

class Ajax extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( array('prodi_model','pengajuan_model','konsultasi_model'));
		$this->load->library( 'form_validation' );
		$this->load->helper( array( 'upload', 'master','notification' ) );
	}

	public function initImport() {
		$data = do_upload( 'file' );
		echo json_encode( array( 'status' => 'success' ) );

	}
	public function check_bimbingan(){
		$konsultasi = $this->konsultasi_model;
		$data = $konsultasi->check_bimbingan();
		echo json_encode(array('data'=>$data));
	}
	public function remove_bimbingan(){
		$file = './file_upload/bimbingan/'.$_POST['file_name'];
		$konsultasi = $this->konsultasi_model;
		$status = $konsultasi->remove_bimbingan($_POST['file_name']);
		if ((is_readable($file) && unlink($file)) and $status) {
			echo json_encode(array('status'=>"The file has been deleted"));
		} else {
			echo json_encode(array('status'=>"The file was not found or not readable and could not be deleted"));
		}
	}
	public function upload_bimbingan(){
		$data = do_upload_bimbingan();
		$konsultasi = $this->konsultasi_model;
		if($konsultasi->upload_bimbingan($data['upload_data']['file_name'])){
			$data = array('status'=>'success','data'=>$data);
		}
		else{
			$data = array('status'=>'error','data'=>'Failed to upload bimbingan');
		}
		echo json_encode($data);
	}
	public function uploadbukti() {
		$id = $this->input->get('id');
		$nim = $this->session->userdata('id');
		$mhs = masterdata( 'tb_mahasiswa',"nim = '{$nim}'",'nama_mahasiswa',false);
		//id == id perusahaan
		$data = do_upload_doc( 'file' );
		$file = $data['upload_data'];
		$this->pengajuan_model->update_multi(array('bukti_diterima'=>$file['full_path'],'status'=>'pending'),array('id_perusahaan'=>$id));
		set_notification( $nim, 'admin', "{$mhs->nama_mahasiswa} ({$nim}) telah mengirim bukti penerimaan magang", 'bukti diterima','mahasiswa?m=pengajuan');
		//inject full path
		echo json_encode( array( 'status' => 'success' ) );
	}
}
