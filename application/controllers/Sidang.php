<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('perusahaan_model', 'pengajuan_model', 'seminar_model', 'penilaian_model'));
		$this->load->helper(array('notification', 'master'));
		!$this->session->userdata('level') ? redirect(site_url('main')) : null;
		$id = $this->session->userdata('id');
		$mahasiswa = masterdata('tb_mahasiswa', array('nim' => $id), array('alamat_mhs', 'email_mhs', 'jenis_kelamin_mhs'), false);
		if ($mahasiswa) {
			($mahasiswa->alamat_mhs == null || $mahasiswa->email_mhs == null || $mahasiswa->jenis_kelamin_mhs == null) ? redirect(site_url('user/profile')) : null;
		}
		//Do your magic here
	}

	public function index()
	{
		$level = $this->session->userdata('level');
		switch ($level) {
			case 'mahasiswa':
				$data['menus'] = array(
					array('name' => 'Jadwal Seminar',
						'href' => site_url('sidang?m=jadwal'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Informasi terkait jadwal seminar peserta prakerin'),
					array('name' => 'Penilaian Seminar',
						'href' => site_url('sidang?m=penilaian'),
						'icon' => 'fas fa-building',
						'desc' => 'Penilaian peserta seminar prakerin'),
				);
				break;
			case 'dosen':
				$data['menus'] = array(
					array('name' => 'Jadwal Seminar',
						'href' => site_url('sidang?m=jadwal'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Informasi terkait jadwal seminar peserta prakerin'),
					array('name' => 'Penilaian',
						'href' => site_url('sidang?m=penilaian'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Penilaian mahasiswa seminar')
				);
				break;
			default:
				$data['menus'] = array();
		}
		if (isset($_GET['m'])) {
			switch ($_GET['m']) {
				case 'jadwal':
					if (isset($_GET['a']) and $_GET['a'] == 'accept') {
//						return $this->acc_bimbingan_mhs();
					}
					if (isset($_GET['a']) and $_GET['a'] == 'decline') {
//						return $this->dec_bimbingan_mhs();
					}
					return $this->index_jadwal_seminar();
					break;
				case 'penilaian':
					if (isset($_GET['q']) and $_GET['q'] == 'i') {
						return $this->insert_penilaian();
					}
					if (isset($_GET['q']) and $_GET['q'] == 'u') {
						return $this->update_penilaian();
					}
					return $this->index_penilaian_seminar();
					break;
				default:
					null;
			}
		}
		$data['intro'] = array(array('step_intro' => 1, 'message_intro' => 'Selamat datang di bimbingan, klik tanggal anda ingin mengajukan konsultasi'));
		return $this->load->view('user/sidang', $data);
	}

	public function insert_penilaian()
	{
		$seminar = $this->seminar_model;
		if ($seminar->insert_penilaian()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function update_penilaian()
	{
		$seminar = $this->seminar_model;
		if ($seminar->update_penilaian()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function index_penilaian_seminar()
	{
		$data = array();
		$post = $this->input->post();
		$get = $this->input->get();
		$seminar = $this->seminar_model;
		$id = $this->session->userdata('nip_nik');
		$date = date('Y-m-d');
		$time = date('H:i');
		if (isset($get['section']) and $get['section'] == 'history') {
			//history revisi
			$riwayat_uji = $seminar->get_jadwal_past($id, $date, $time);
			$pegawai = masterdata('tb_pegawai', "nip_nik = '$id'", 'nama_pegawai', false);
			if (count($riwayat_uji) > 0) {
				foreach ($riwayat_uji as $index => $uji) {
					$riwayat_uji[$index]->sebagai = array_search($pegawai->nama_pegawai, (array)$uji);
					$riwayat_uji[$index]->session = $id;
				}
			}
			$data['riwayat_uji'] = $riwayat_uji;
			if (isset($post['req']) and $post['req'] === 'ajax') {
				echo json_encode($riwayat_uji);
				return;
			}
		} else {
			$pegawai = masterdata('tb_pegawai', "nip_nik = '$id'", 'nama_pegawai', false);
			$jadwaluji = $seminar->get_jadwal_today($id, $date);
			if (count($jadwaluji) > 0) {
				foreach ($jadwaluji as $index => $uji) {
					$jadwaluji[$index]->sebagai = array_search($pegawai->nama_pegawai, (array)$uji);
					$jadwaluji[$index]->session = $id;
				}
			}
			$datetime = new DateTime($date);
			$datetime->modify('+1 day');
			$tomorrow = $datetime->format('Y-m-d');
			$jadwaluji_besok = $seminar->get_jadwal_today($id, $tomorrow);
			if (count($jadwaluji_besok) > 0) {
				foreach ($jadwaluji_besok as $index => $uji) {
					$jadwaluji_besok[$index]->sebagai = array_search($pegawai->nama_pegawai, (array)$uji);
					$jadwaluji_besok[$index]->session = $id;
				}
			}
			$data['jadwaluji'] = $jadwaluji;
			$data['besok'] = $jadwaluji_besok;
			if (isset($post['req']) and $post['req'] === 'ajax') {
				echo json_encode($jadwaluji);
				return;
			}
			//penilaian terlewat
			$riwayat_uji_terlewat = $seminar->get_jadwal_past_left($id, $date, $time);
			if (count($riwayat_uji_terlewat) > 0) {
				foreach ($riwayat_uji_terlewat as $index => $uji) {
					$riwayat_uji_terlewat[$index]->sebagai = array_search($pegawai->nama_pegawai, (array)$uji);
					$riwayat_uji_terlewat[$index]->session = $id;
				}
			}
			if (isset($post['req']) and $post['req'] === 'ajax_left') {
				echo json_encode($riwayat_uji_terlewat);
				return;
			}
			$data['riwayat_uji_terlewat'] = $riwayat_uji_terlewat;
		}
		$this->load->view('user/sidang_penilaian', $data);
	}

	public function index_jadwal_seminar()
	{
		$data = array();
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if ($level === 'mahasiswa') {
			$where = "WHERE tm.nim = '$id'";
		} elseif ($level === 'dosen') {
			$where = "WHERE td1.nip_nik = '$id' OR td2.nip_nik = '$id'";
		}
		$data['tempat'] = $this->seminar_model->get_tempat_seminar($alias = "title");
		$data['jadwalku'] = $this->seminar_model->get_jadwal($where);
		$this->load->view('user/sidang_jadwal', $data);
	}
}

/* End of file Magang.php */
?>
