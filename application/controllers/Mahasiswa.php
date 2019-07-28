<?php

use Tools\Excel;

require APPPATH . 'libraries/Excel.php';
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

// Use upload Library and Excel library

class Mahasiswa extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( array( 'upload', 'master', 'notification' ) );
		$this->load->model( [ 'mahasiswa_model', 'pengajuan_model', 'akun_model', 'pilihperusahaan_model' ] );
		$this->load->library( 'form_validation' );
		//middleware
		! $this->session->userdata( 'level' ) ? redirect( site_url( 'main' ) ) : null;
	}

	public function index() {
		$join          = [ 'tahun_akademik', 'tb_waktu.id_tahun_akademik = tahun_akademik.id_tahun_akademik', 'inner' ];
		$tahunAkademik = datajoin( 'tb_waktu', null, 'tahun_akademik.tahun_akademik', $join, null );
		$level         = $this->session->userdata( 'level' );
		switch ( $level ) {
			case 'admin':
				$data['menus'] = array(
					array(
						'name' => 'Pengajuan Magang',
						'href' => site_url( 'mahasiswa?m=pengajuan' ),
						'icon' => 'fas fa-users',
						'desc' => 'Daftar perserta pengajuan magang seluruh program studi'
					),
					array(
						'name' => 'Berhak Magang',
						'href' => site_url( 'mahasiswa?m=magang' ),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Pengelolaan mahasiswa yang berhak untuk melaksanakan magang'
					),
					array(
						'name' => 'Berhak Sidang',
						'href' => site_url( 'mahasiswa?m=sidang' ),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Pengelolaan mahasiswa yang berhak dan tidak berhak untuk melaksanakan sidang'
					),
					array(
						'name' => "Mahasiswa Magang (FIX) tahun {$tahunAkademik[0]->tahun_akademik}",
						'href' => site_url( 'mahasiswa?m=fixmagang' ),
						'icon' => 'fas fa-chalkboard-teacher',
						'desc' => 'Daftar mahasiswa yang sudah diterima oleh perusahaan'
					),
					array(
						'name' => "Status Mahasiswa Magang tahun {$tahunAkademik[0]->tahun_akademik}",
						'href' => site_url( 'mahasiswa?m=status' ),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Daftar status mahasiswa yang saat ini sedang proses melakukan pengajuan magang pada perusahaan'
					),
				);
				break;
			//if there are not level except in case, it will throw to error with code 403
			default:
				show_error( "Access Denied. You Do Not Have The Permission To Access This Page On This
            Server", 403, "Forbidden, you don't have pemission" );
		}
		//get variable
		//sub menu, with crud
		$get = $this->input->get();
		if ( isset( $get['m'] ) ) {
			switch ( $get['m'] ) {
				case 'magang':
					if ( isset( $get['q'] ) && $get['q'] == 'i' ) {
						return $this->create_magang();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'u' ) {
						return $this->edit_magang();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'd' ) {
						return $this->remove_magang();
					}

					return $this->index_magang();
					break;
				case 'fixmagang':
					return $this->index_fixmagang();
					break;
				case 'status':
					return $this->index_status_magang();
					break;
				case 'sidang':
					$post = $this->input->post();
					if ( isset( $post['insert'] ) ) {
						$this->create_informasi( $post );
					}
					if ( isset( $post['update'] ) ) {
						$this->edit_informasi( $post );
					}
					if ( isset( $post['delete'] ) ) {
						$this->remove_informasi( $post );
					}

					return $this->index_sidang();
					break;
				case 'pengajuan':
					if ( isset( $get['q'] ) && $get['q'] == 'p' ) {
						return $this->print_pengajuan();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'ptugas' ) {
						return $this->print_surat_tugas();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'accept' ) {
						return $this->accept_pengajuan();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'decline' ) {
						return $this->decline_pengajuan();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'view' ) {
						return $this->view_pengajuan();
					}
					if ( isset( $get['q'] ) && $get['q'] == 'notif' ) {
						$level = $this->session->userdata( 'level' );
						if ( $level != null ) {
							return $this->info_pengajuan();
						}

						return null;
					}

					return $this->index_pengajuan();
					break;
				default:
					redirect( site_url( 'mahasiswa' ) );
			}
		}

		$this->load->view( 'admin/mahasiswa', $data );


	}
	//status magang mahasiswa
	public function index_status_magang(){
		$join = [
			['tb_program_studi tp','tp.id_program_studi = tm.id_program_studi','inner'],
			['tb_mhs_pilih_perusahaan pilih','pilih.nim = tm.nim','left outer']
		];
		$belum = datajoin( '(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tm', 'pilih.nim is null','tm.*,tp.nama_program_studi,0 as status',$join);
		$sudah = datajoin( '(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tm', 'pilih.nim is not null','tm.*,tp.nama_program_studi,1 as status ',$join);

		$data['mahasiswas'] = array_merge( $belum,$sudah);
		$data['sudah'] = count($sudah);
		$data['belum'] = count($belum);
		$data['all'] = count(array_merge( $belum,$sudah));
		$this->load->view('admin/mahasiswa_status',$data);
	}
	//sidang

	public function index_sidang(){
		var_dump("UNDER DEVELOPMENT");
	}

	//fix magang
	public function index_fixmagang() {
		$join               = [];
		$join[0]            = [ '(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tb_mahasiswa', 'tb_mahasiswa.nim = tb_mhs_pilih_perusahaan.nim', 'inner' ];
		$join[1]            = [
			'tb_perusahaan',
			'tb_perusahaan.id_perusahaan = tb_mhs_pilih_perusahaan.id_perusahaan',
			'inner'
		];
		$join[2]            = [
			'tb_program_studi',
			'tb_program_studi.id_program_studi = tb_perusahaan.id_program_studi',
			'left outer'
		];
		$data['mahasiswas'] = $this->pilihperusahaan_model->getAll( null, null, $join );//need filter only magang
		$this->load->view( 'admin/mahasiswa_magang_fix', $data );

	}

	//import magang (AJAX)
	public function import() {
		$post = $this->input->post();
		//POST must containt data mahasiswa, tahunakademik and prodi
		// $data = do_upload('userfile');
		// $file = $data['upload_data'];
		if ( isset( $post['mahasiswas'] ) ) {
			$mahasiswas                          = json_decode( $post['mahasiswas'] );
			$addtionalDatas['id_tahun_akademik'] = $post['id_tahun_akademik'];
			$addtionalDatas['id_program_studi']  = $post['id_program_studi'];
			$response                            = $this->akun_model->insert_batch( $mahasiswas, 'mahasiswa', $addtionalDatas );
//			var_dump( $response );
			if ( $response['status'] ) {
				$this->session->set_flashdata( 'success', 'Data berhasil di import' );
				$this->session->set_flashdata( 'status', (object) $response );
			}
		}


	}

	//magang
	public function index_magang() {
		$data['mahasiswas'] = $this->mahasiswa_model->getAll();//need filter only magang
		$this->load->view( 'admin/mahasiswa_magang', $data );
	}

	public function create_magang() {

	}

	public function edit_magang() {

	}

	public function remove_magang() {

	}

	//pengajuan
	public function view_pengajuan() {
		//id perusahaan
		$id = $this->input->get( 'id' );
		if ( isset( $id ) ) {
			$getBuktiPerimaan = masterdata( 'tb_perusahaan_sementara', "id_perusahaan = {$id}", 'bukti_diterima', true );
			//ambil array pertama, karena data pada perusahaan yang sama punya bukti penerimaan yang sama
			$data['id']     = $id;
			$data['berkas'] = $getBuktiPerimaan[0]->bukti_diterima;

			return $this->load->view( 'admin/mahasiswa_pengajuan_diterima', $data );
		}
		redirect( site_url( 'mahasiswa?m=pengajuan' ) );
	}

	public function accept_pengajuan() {
		$id              = $this->input->get( 'id' );
		$mahasiswaMagang = masterdata( 'tb_perusahaan_sementara', "id_perusahaan = {$id}", 'nim', true );
		//id perusahaan
		if ( isset( $id ) ) {
			$data ['status']        = 'terima';
			$where['id_perusahaan'] = $id;
			$this->pengajuan_model->update_multi( $data, $where );
			foreach ( $mahasiswaMagang as $mhsMagang ) {
				$data['id_perusahaan'] = $id;
				$data ['nim']          = $mhsMagang->nim;
				$this->pilihperusahaan_model->insert( $data );
			}
			$this->session->set_flashdata( 'status', 'Surat Persetujuan berhasil di setujui' );
		}
		redirect( site_url( 'mahasiswa?m=pengajuan' ) );
	}

	public function decline_pengajuan() {
		$id = $this->input->get( 'id' );
		//id perusahaan
		if ( isset( $id ) ) {
			$where['id_perusahaan'] = $id;
			$data ['status']        = 'tolak';
			$this->pengajuan_model->update_multi( $data, $where );
		}
		redirect( site_url( 'mahasiswa?m=pengajuan' ) );

	}

	public function info_pengajuan() {
		$id = $this->input->get( 'id' );
		//idperusahaan
		$level       = $this->session->userdata( 'level' );
		$getPenerima = masterdata( 'tb_perusahaan_sementara', "id_perusahaan = {$id}", 'nim', true );
		if ( count( $getPenerima ) > 0 ) {
			foreach ( $getPenerima as $penerima ) {
				//set notification and set status permohonan
				set_notification( $level, $penerima->nim, 'Surat sudah ditandatangani, siap untuk dikirimkan', 'surat siap', 'magang?m=pengajuan' );
				$this->pengajuan_model->update_multi( [ 'status' => 'kirim' ], [ 'id_perusahaan' => $id ] );
			}

			$this->session->set_flashdata( 'status', 'Informasi surat siap sudah dikirim' );
			redirect( site_url( 'mahasiswa?m=pengajuan' ) );
		}
	}

	public function daftar_pengajuan() {
		$where['tb_perusahaan.status_perusahaan'] = 'whitelist';
		$join                                     = [
			'tb_program_studi',
			'tb_perusahaan.id_program_studi=tb_program_studi.id_program_studi',
			'left outer'
		];
		$select                                   = [
			'id_perusahaan',
			'nama_perusahaan',
			'kuota_pkl',
			'tb_program_studi.nama_program_studi',
		];
		$data['perusahaans']                      = datajoin( 'tb_perusahaan', $where, $select, $join, null );
		foreach ( $data['perusahaans'] as $index => $perusahaan ) {
			$where                                    = [
				'tb_perusahaan.status_perusahaan'       => 'whitelist',
				'tb_perusahaan_sementara.id_perusahaan' => $perusahaan->id_perusahaan
			];
			$joins[0]                                 = [
				'tb_perusahaan',
				'tb_perusahaan.id_perusahaan=tb_perusahaan_sementara.id_perusahaan',
				'left outer'
			];
			$joins[1]                                 = [
				'(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik)tb_mahasiswa',
				'tb_mahasiswa.nim=tb_perusahaan_sementara.nim',
				'inner'
			];
			$select                                   = [ 'nama_mahasiswa', 'tanggal_pengajuan', 'status' ];
			$data['perusahaans'][ $index ]->mahasiswa = datajoin( 'tb_perusahaan_sementara', $where, $select, $joins, null );
		}
		//filter array , purge mahasiswa = []

		$pengajuans           = array_filter( $data['perusahaans'], function ( $perusahaan ) {
			if ( count( $perusahaan->mahasiswa ) > 0 ) {
				return $perusahaan;
			}
		} );
		$ajuan['perusahaans'] = [];
		foreach ( $pengajuans as $pengajuan ) {
			array_push( $ajuan['perusahaans'], $pengajuan );
		}
		echo json_encode( $ajuan );

	}

	public function print_surat_tugas() {
		$get                   = $this->input->get();
		$level                 = $this->session->userdata( 'level' );
		$where                 = [
			'tb_perusahaan.status_perusahaan'       => 'whitelist',
			'tb_perusahaan_sementara.id_perusahaan' => $get['id']
		];
		$joins[0]              = [
			'tb_perusahaan',
			'tb_perusahaan.id_perusahaan=tb_perusahaan_sementara.id_perusahaan',
			'left outer'
		];
		$joins[1]              = [
			'tb_mahasiswa',
			'tb_mahasiswa.nim=tb_perusahaan_sementara.nim',
			'left outer'
		];
		$joins[2]              = [
			'tb_program_studi',
			'tb_program_studi.id_program_studi=tb_perusahaan.id_program_studi',
			'left outer'
		];
		$select                = [
			'tb_program_studi.nama_program_studi',
			'tb_perusahaan.nama_perusahaan',
			'tb_perusahaan.kuota_pkl',
			'nama_mahasiswa',
			'tb_mahasiswa.nim',
			'tanggal_pengajuan'
		];
		$data['permohonan']    = datajoin( 'tb_perusahaan_sementara', $where, $select, $joins, null );
		$data['id_perusahaan'] = $get['id'];
		if ( isset( $get['save'] ) ) {
			//update status proses permohonan if save is define
			$id['id_perusahaan'] = $get['id'];
			foreach ( $data['permohonan'] as $perm ) {
				set_notification( $level, $perm->nim, 'Surat tugas sudah dicetak, silahkan hubungi prakerin untuk informasi selanjutnya', 'surat tugas siap', null );
			}

			return $this->load->view( 'admin/surat_tugas', $data );
		}
		$this->load->view( 'admin/mahasiswa_pengajuan_print_surat_tugas', $data );
	}

	public function print_pengajuan() {
		$get = $this->input->get();
		$post = $this->input->post();
		//id perusahaan

		//sending parameter to surat permohoanan
		$where                 = [
			'tb_perusahaan.status_perusahaan'       => 'whitelist',
			'tb_perusahaan_sementara.id_perusahaan' => $get['id']
		];
		$joins[0]              = [
			'tb_perusahaan',
			'tb_perusahaan.id_perusahaan=tb_perusahaan_sementara.id_perusahaan',
			'left outer'
		];
		$joins[1]              = [
			'tb_mahasiswa',
			'tb_mahasiswa.nim=tb_perusahaan_sementara.nim',
			'left outer'
		];
		$joins[2]              = [
			'tb_program_studi',
			'tb_program_studi.id_program_studi=tb_perusahaan.id_program_studi',
			'left outer'
		];
		$select                = [
			'tb_program_studi.nama_program_studi',
			'tb_perusahaan.nama_perusahaan',
			'tb_perusahaan.kuota_pkl',
			'nama_mahasiswa',
			'tb_mahasiswa.nim',
			'tanggal_pengajuan'
		];
		$data['permohonan']    = datajoin( 'tb_perusahaan_sementara', $where, $select, $joins, null );
		$data['id_perusahaan'] = $get['id'];
		$data['nomor_surat'] = masterdata( 'tb_jenis_surat', 'nama_jenis_surat = "Permohonan Magang"','suffix_no_surat');
//		var_dump( $data);
		if ( isset( $post['button'] ) ) {
			//update status proses permohonan if save is define
			$id['id_perusahaan'] = $post['id'];
			$data['urut'] = $post['urut'];
			$update['status']    = 'cetak';
			$this->pengajuan_model->update_multi( $update, $id );

			return $this->load->view( 'admin/surat_pengajuan', $data );
		}
		$this->load->view( 'admin/mahasiswa_pengajuan_print', $data );
//		redirect(site_url('mahasiswa?m=pengajuan'));
	}

	public function index_pengajuan() {
		$where['tb_perusahaan.status_perusahaan'] = 'whitelist';
		$join                                     = [
			'tb_program_studi',
			'tb_perusahaan.id_program_studi=tb_program_studi.id_program_studi',
			'left outer'
		];
		$select                                   = [
			'id_perusahaan',
			'nama_perusahaan',
			'kuota_pkl',
			'tb_program_studi.nama_program_studi'
		];
		$data['perusahaans']                      = datajoin( 'tb_perusahaan', $where, $select, $join, null );
		$this->load->view( 'admin/mahasiswa_pengajuan', $data );
	}

	public function create_pengajuan() {

	}

	public function edit_pengajuan() {

	}

	public function remove_pengajuan() {

	}

	////////////////////////////////// create mahasiswa magang
	public function create() {
		$mahasiswa  = $this->mahasiswa_model;
		$validation = $this->form_validation;
		$validation->set_rules( $mahasiswa->rules() );
		if ( $validation->run() ) {
			if ( $mahasiswa->insert() ) {
				$this->session->set_flashdata( 'notif',(object) [
					'message' => 'Data berhasil disimpan',
					'type'    => 'success'
				] );
			} else {
				$this->session->set_flashdata( 'notif',(object) [ 'message' => 'Data gagal disimpan', 'type' => 'fail' ] );
			}
			redirect( 'mahasiswa?m=magang' );
		}
		$this->load->view( 'admin/mahasiswa_magang_tambah' );
	}

	public function edit( $id = null ) {
		if ( ! isset( $id ) ) {
			redirect( 'mahasiswa?m=magang' );
		}
		$mahasiswa  = $this->mahasiswa_model;
		$validation = $this->form_validation;
		$validation->set_rules( $mahasiswa->rules() );
		if ( $validation->run() ) {
			if($mahasiswa->update()){
				$this->session->set_flashdata( 'notif',(object) [
					'message' => 'Data berhasil disimpan',
					'type'    => 'success'
				] );
			}
			else{
				$this->session->set_flashdata( 'notif',(object) [ 'message' => 'Data gagal disimpan', 'type' => 'fail' ] );
			}
			redirect( 'mahasiswa?m=magang' );

		}
		$data['mahasiswa'] = $mahasiswa->getById( $id );
		if ( ! $data['mahasiswa'] ) {
			show_404();
		}
		$this->load->view( 'admin/mahasiswa_magang_edit', $data );
	}

	public function remove( $id = null ) {
		if ( ! isset( $id ) ) {
			show_404();
		}
		if ( $this->mahasiswa_model->delete( $id ) ) {
			$this->session->set_flashdata( 'notif',(object) [ 'message' => 'Data berhasil dihapus', 'type' => 'success' ] );
			redirect( site_url( 'mahasiswa?m=magang' ) );
		}
		else{
			$this->session->set_flashdata( 'notif',(object) [ 'message' => 'Data gagal dihapus', 'type' => 'fail' ] );
		}
	}


} ?>