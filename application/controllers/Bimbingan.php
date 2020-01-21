<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Bimbingan
 */
class Bimbingan extends CI_Controller
{

	/**
	 * Bimbingan constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('perusahaan_model', 'pengajuan_model', 'konsultasi_model', 'pembimbing_model'));
		$this->load->helper(array('notification', 'master'));
		!$this->session->userdata('level') ? redirect(site_url('main')) : null;
		$id = $this->session->userdata('id');
		$mahasiswa = masterdata('tb_mahasiswa', array('nim' => $id), array('alamat_mhs', 'email_mhs', 'jenis_kelamin_mhs'), false);
		if ($mahasiswa) {
			($mahasiswa->alamat_mhs == null || $mahasiswa->email_mhs == null || $mahasiswa->jenis_kelamin_mhs == null) ? redirect(site_url('user/profile')) : null;
		}
		//Do your magic here
	}

	/**
	 * @return void|null
	 */
	public function index()
	{
		//level
		$level = $this->session->userdata('level');
		switch ($level) {
			case 'mahasiswa':
				$data['menus'] = array(
					array('name' => 'Konsultasi Bimbingan',
						'href' => site_url('bimbingan?m=konsultasi'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Konsultasi bimbingan kepada dosen pembimbing masing-masing yang diwajibkan tiap minggunya'),
					array('name' => 'Pengajuan Judul',
						'href' => site_url('bimbingan?m=pengajuan_judul'),
						'icon' => 'fas fa-building',
						'desc' => 'Pengajuan judul ketika mahasiswa sudah mendapatkan kasus ditempat magang'),
					array('name' => 'Pengajuan Sidang',
						'href' => site_url('bimbingan?m=pengajuan_sidang'),
						'icon' => 'fas fa-building',
						'desc' => 'Pengajuan sidang wajib di konsultasikan kepada dosen pembimbing'),
				);
				break;
			case 'dosen':
				$data['menus'] = array(
					array('name' => 'Mahasiswa Bimbingan',
						'href' => site_url('bimbingan?m=daftar_bimbingan'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Bimbingan Prakerin masing-masing dosen'),
					array('name' => 'Approval Judul',
						'href' => site_url('bimbingan?m=approvejudul'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Persetujuan permintaan judul mahasiswa oleh dosen pembimbing'),
					array('name' => 'Approval Seminar',
						'href' => site_url('bimbingan?m=approvesidang'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Persetujuan permintaan sidang mahasiswa oleh dosen pembimbing'),
				);
				break;
			default:
				$data['menus'] = array();
		}
		//Route
		if (isset($_GET['m'])) {
			switch ($_GET['m']) {
				case 'bimbingan_online':
					if (isset($_GET['a']) and $_GET['a'] == 'accept') {
						return $this->acc_bimbingan_mhs();
					}
					if (isset($_GET['a']) and $_GET['a'] == 'decline') {
						return $this->dec_bimbingan_mhs();
					}
					return $this->index_bimbingan_online();
					break;
				case 'daftar_bimbingan':
					return $this->index_daftar_bimbingan();
					break;
				case 'bimbingan_offline':
					return $this->index_bimbingan_offline();
					break;
				case 'belum_bimbingan':
					return $this->index_belum_bimbingan();
					break;
				case 'view_bimbingan_offline':
					return $this->index_view_bimbingan_offline();
					break;
				case 'approvesidang':
					if (isset($_GET['a']) and $_GET['a'] == 'acc') {
						return $this->change_status_seminar('setuju');
					}
					if (isset($_GET['a']) and $_GET['a'] == 'dec') {
						return $this->change_status_seminar('ulang');
					}
					return $this->index_approve_sidang();
					break;
				case 'approvejudul':
					if (isset($_GET['a']) and $_GET['a'] == 'acc') {
						return $this->change_status_judul('setuju');
					}
					if (isset($_GET['a']) and $_GET['a'] == 'dec') {
						return $this->change_status_judul('ulang');
					}
					return $this->index_approve_judul();
					break;
				case 'konsultasi':
					if (isset($_GET['q']) and $_GET['q'] == 'i') {
						return $this->insert_konsultasi();
					} elseif (isset($_GET['q']) and $_GET['q'] == 'u') {
						return $this->update_konsultasi();
					} elseif (isset($_GET['q']) and $_GET['q'] == 'd') {
						return $this->delete_konsultasi();
					} elseif (isset($_GET['q']) and $_GET['q'] == 'is_exist') {
						return $this->is_pembimbing_exist();
					} elseif (isset($_GET['q']) and $_GET['q'] == 'pengajuan_judul') {
						return $this->pengajuan_judul();
					}
					return $this->index_konsultasi();
					break;
				default:
					null;
			}
		}
		//default route
		$this->load->view('user/bimbingan', $data);
	}

	// Dosen

	/**
	 * @return mixed
	 */
	function index_daftar_bimbingan()
	{
		$konsultasi = $this->konsultasi_model;
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$data['daftar_mahasiswa'] = $pembimbing->get_all_with_mhs($nip_nik);
		}
		return $this->load->view('user/bimbingan_mahasiswa', $data);
	}

	/**
	 * @return mixed
	 */
	function index_view_bimbingan_offline()
	{
		$nip_nik = $this->session->userdata('nip_nik');
		$get = $this->input->get();
		$pembimbing = $this->pembimbing_model;
		$data['mahasiswa'] = $pembimbing->get_mhs_bimbingan_offline($nip_nik, $get['id']);
		return $this->load->view('user/bimbingan_view_offline');
	}

	/**
	 * @return mixed
	 */
	function index_bimbingan_online()
	{
		$konsultasi = $this->konsultasi_model;
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$data['bimbingan_online'] = $pembimbing->get_mhs_bimbingan_online($nip_nik);
		}
		return $this->load->view('user/bimbingan_online', $data);
	}

	/**
	 * @return mixed
	 */
	function index_bimbingan_offline()
	{
		$konsultasi = $this->konsultasi_model;
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$data['bimbingan_offline'] = $pembimbing->get_mhs_bimbingan_offline($nip_nik);
		}
		return $this->load->view('user/bimbingan_offline', $data);
	}

	/**
	 * @return mixed
	 */
	function index_belum_bimbingan()
	{
		$konsultasi = $this->konsultasi_model;
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$data['belum_bimbingan'] = $pembimbing->get_mhs_belum_bimbingan($nip_nik);
		}
		return $this->load->view('user/bimbingan_belum', $data);
	}

	/**
	 *
	 */
	function acc_bimbingan_mhs()
	{
		$konsultasi = $this->konsultasi_model;
		if ($konsultasi->accept()) {
			$this->session->set_flashdata('status', (object)array('status' => 'Success', 'message' => 'Konsultasi berhasil dikonfirmasi', 'alert' => 'success'));
		} else {
			$this->session->set_flashdata('status', (object)array('status' => 'Error', 'message' => 'Konsultasi gagal dikonfirmasi', 'alert' => 'danger'));
		}
		redirect(site_url('bimbingan?m=bimbingan_online'));

	}

	/**
	 *
	 */
	function dec_bimbingan_mhs()
	{
		$konsultasi = $this->konsultasi_model;
		if ($konsultasi->decline()) {
			$this->session->set_flashdata('status', (object)array('status' => 'Success', 'message' => 'Konsultasi berhasil dikonfirmasi', 'alert' => 'success'));
		} else {
			$this->session->set_flashdata('status', (object)array('status' => 'Error', 'message' => 'Konsultasi gagal dikonfirmasi', 'alert' => 'danger'));
		}
		redirect(site_url('bimbingan?m=bimbingan_online'));

	}

	/**
	 * @return mixed
	 */
	function index_approve_judul()
	{
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$data['mahasiswas'] = $pembimbing->get_all_pengajuan_judul($nip_nik);
		}
		return $this->load->view('user/bimbingan_pengajuan_judul',$data);
	}

	/**
	 * @param $action
	 */
	function change_status_judul($action){
		$pembimbing = $this->pembimbing_model;
		if($pembimbing->change_status_judul($action)){
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Success', 'alert' => 'success', 'message' => 'Judul berhasil disetujui')));
		}
		else{
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Error', 'alert' => 'success', 'message' => 'Judul gagal disetujui')));
		}
		redirect(site_url('bimbingan?m=approvejudul'));
	}

	/**
	 * @return mixed
	 */
	function index_approve_sidang()
	{
		$pembimbing = $this->pembimbing_model;
		$nip_nik = $this->session->userdata('nip_nik');
		$data['mahasiswas'] = array();
		if (isset($nip_nik)) {
			$bimbingan_online = $pembimbing->get_mhs_bimbingan_online($nip_nik);
			$bimbingan_offline = $pembimbing->get_mhs_bimbingan_offline($nip_nik);
			$data['mahasiswas'] = array_merge($bimbingan_online,$bimbingan_offline);
		}
		return $this->load->view('user/bimbingan_pengajuan_sidang',$data);
	}

	/**
	 * @param $action
	 */
	function change_status_seminar($action){
		$pembimbing = $this->pembimbing_model;
		if($pembimbing->change_status_seminar($action)){
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Success', 'alert' => 'success', 'message' => 'Judul berhasil disetujui')));
		}
		else{
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Error', 'alert' => 'success', 'message' => 'Judul gagal disetujui')));
		}
		redirect(site_url('bimbingan?m=approvesidang'));
	}

	// Mahasiswa

	/**
	 *
	 */
	function is_pembimbing_exist()
	{
		$pembimbing = $this->pembimbing_model;
		echo json_encode($pembimbing->is_has());
	}

	/**
	 * @return |null
	 */
	function index_konsultasi()
	{
		$konsultasi = $this->konsultasi_model;
		$pembimbing = $this->pembimbing_model;
		if (isset($_POST['events'])) {
			echo json_encode($konsultasi->get());
			return null;
		}
		$data['pembimbing'] = $pembimbing->is_has();
		$data['check_bimbingan'] = $konsultasi->check_bimbingan();
		$data['intro'] = array(array('step_intro' => 1, 'message_intro' => 'Selamat datang di bimbingan, klik tanggal anda ingin mengajukan konsultasi'));
		return $this->load->view('user/bimbingan_konsultasi', $data);
	}

	/**
	 *
	 */
	function insert_konsultasi()
	{
		$konsultasi = $this->konsultasi_model;
		if (isset($_GET['q'])) {
			$konsultasi->insert();
		}
	}

	/**
	 *
	 */
	function update_konsultasi()
	{
		$konsultasi = $this->konsultasi_model;
		if (isset($_GET['q'])) {
			$konsultasi->update();
		}
	}

	/**
	 *
	 */
	function delete_konsultasi()
	{
		$konsultasi = $this->konsultasi_model;
		if (isset($_GET['q'])) {
			$konsultasi->delete();
		}
	}

	/**
	 *
	 */
	function pengajuan_judul()
	{
		$pembimbing = $this->pembimbing_model;
		if ($pembimbing->pengajuan_judul()) {
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Success', 'alert' => 'success', 'message' => 'Pengajuan judul berhasil, silahkan tunggu dosen untuk mengkonfirmasi')));
		} else {
			$this->session->set_flashdata(array('status' => (object)array('status' => 'Error', 'alert' => 'danger', 'message' => 'Pengajuan judul gagal dilakukan, silahkan coba lagi nanti')));
		}
		redirect(site_url('bimbingan?m=konsultasi'));
	}

}

/* End of file Bimbingan.php */
?>
