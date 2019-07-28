<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

use Tools\Excel;

require APPPATH . 'libraries/Excel.php';

class Ajax extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( ['prodi_model','pengajuan_model']);
		$this->load->library( 'form_validation' );
		$this->load->helper( [ 'upload', 'master','notification' ] );
	}

	public function initImport() {
		$data = do_upload( 'file' );
		// $file = $data['upload_data'];
		// // var_dump($file);
		// $excel = new Excel;
		// $type = ucfirst(substr($file['file_ext'],1));
		// $sheetNames = $excel->readSheetName($file['full_path'],$type);
		//inject full path
		echo json_encode( array( 'status' => 'success' ) );

		// $excel = new Excel;
		// $type = ucfirst(substr($file['file_ext'],1));
		// var_dump($type);
		// $sheetNames = $excel->readSheetName($file['full_path'],$type);
	}

	public function uploadbukti() {
		$id = $this->input->get('id');
		$nim = $this->session->userdata('id');
		$mhs = masterdata( 'tb_mahasiswa',"nim = '{$nim}'",'nama_mahasiswa',false);
		//id == id perusahaan
		$data = do_upload_doc( 'file' );
//		var_dump( $data);
		$file = $data['upload_data'];
//		var_dump( $file['full_path'] );
		$this->pengajuan_model->update_multi(['bukti_diterima'=>$file['full_path'],'status'=>'pending'],['id_perusahaan'=>$id]);
		set_notification( $nim, 'admin', "{$mhs->nama_mahasiswa} ({$nim}) telah mengirim bukti penerimaan magang", 'bukti diterima','mahasiswa?m=pengajuan');
//		redirect(site_url('magang?m=pengajuan'));
		//inject full path
		echo json_encode( array( 'status' => 'success' ) );

		// $excel = new Excel;
		// $type = ucfirst(substr($file['file_ext'],1));
		// var_dump($type);
		// $sheetNames = $excel->readSheetName($file['full_path'],$type);
	}
}