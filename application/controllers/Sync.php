<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Sync extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
		$this->load->helper( 'master' );
		$this->load->model( 'sync_model' );
	}


	public function index() {
		$get = $this->input->get();

		if ( isset( $get['do'] ) ) {
			$level_dosen  = masterdata( 'tb_master_level', 'nama_master_level = "dosen"' );//dosen master level id
			$kepegawaian  = $this->load->database( 'kepegawaian', true );
			$pegawais     = $kepegawaian->query( 'select tb_user.nip,tb_user.UserName,tb_user.Password,tb_user.nama_lengkap, tb_biodata.alamat,tb_biodata.tempat_lahir,tb_biodata.tgl_lahir,tb_biodata.jk from tb_user inner join tb_biodata on tb_user.id_user = tb_biodata.id_user where tb_user.on_off = \'on\' AND UserName REGEXP \'[\@]*politala\.ac\.(.+)\' AND tb_user.id_status_kerja = 1 -- status kerja 1 = dosen' )->result();
			$data_akun    = new stdClass();
			$data_level   = new stdClass();
			$data_pegawai = new stdClass();
			foreach ( $pegawais as $pegawai ) {
				$data_pegawai->nip_nik               = $pegawai->nip;
				$data_pegawai->username              = $pegawai->UserName;
				$data_pegawai->email_pegawai         = $pegawai->UserName;
				$data_pegawai->status                = 'dosen';
				$data_pegawai->nama_pegawai          = $pegawai->nama_lengkap;
				$data_pegawai->alamat_pegawai        = $pegawai->alamat;
				$data_pegawai->tempat_lahir_pegawai  = $pegawai->tempat_lahir;
				$data_pegawai->tanggal_lahir_pegawai = $pegawai->tgl_lahir;
				$data_pegawai->jk_pegawai            = $pegawai->jk;

				$data_akun->username = $pegawai->UserName;
				$data_akun->password = $pegawai->Password;

				$data_level->username        = $pegawai->UserName;
				$data_level->id_master_level = $level_dosen->id_master_level;
				if ( $this->sync_model->insert_or_replace( $data_akun, $data_level, $data_pegawai ) ) {
					$this->session->set_flashdata( 'status',(object) [
						'status'  => 'success',
						'message' => 'Data pegawai berhasil tersinkronasi'
					] );
				} else {
					$this->session->set_flashdata( 'status',(object) [
						'status'  => 'fail',
						'message' => 'Data pegawai gagal tersinkronasi'
					] );
				}

			}
			redirect( site_url( 'sync' ) );
		}
		$this->load->view('admin/sync');
	}

	public function set_pegawai() {
		//insert into akun
		$objectPegawais = json_decode( json_encode( $this->pegawais ) );
		$this->akun_model->insert_batch( $objectPegawais, 'pegawai', [] );
		echo json_encode( [ 'status' => 'success import data pegawai' ] );
		//insert into pegawai
		//insert into level
	}

	public function retrive_pegawai() {
		//  fetcing data from another database
		//	$config['hostname'] = 'localhost';
		//	$config['username'] = 'myusername';
		//	$config['password'] = 'mypassword';
		//	$config['database'] = 'mydatabase';
		//	$config['dbdriver'] = 'mysqli';
		//	$config['dbprefix'] = '';
		//	$config['pconnect'] = FALSE;
		//	$config['db_debug'] = TRUE;
		//	$this->load->model( 'nama_model','',$config );
	}
}