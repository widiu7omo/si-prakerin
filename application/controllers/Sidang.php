<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('perusahaan_model', 'pengajuan_model','seminar_model','penilaian_model'));
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
					if (isset($_GET['a']) and $_GET['a'] == 'accept') {
//						return $this->acc_bimbingan_mhs();
					}
					if (isset($_GET['a']) and $_GET['a'] == 'decline') {
//						return $this->dec_bimbingan_mhs();
					}
					return $this->index_penilaian_seminar();
					break;
				default:
					null;
			}
		}
		$data['intro'] = array(array('step_intro' => 1, 'message_intro' => 'Selamat datang di bimbingan, klik tanggal anda ingin mengajukan konsultasi'));
		$this->load->view('user/sidang', $data);

	}

	public function index_penilaian_seminar(){
		$data = array();
		$this->load->view('user/sidang_penilaian',$data);
	}

	public function index_jadwal_seminar()
	{
		$data = array();
		$id = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		if($level === 'mahasiswa'){
			$where = "WHERE tm.nim = '$id'";
		}
		elseif($level === 'dosen'){
			$where = "WHERE td1.nip_nik = '$id' OR td2.nip_nik = '$id'";
		}
		$data['tempat'] = $this->seminar_model->get_tempat_seminar($alias = "title");
		$data['jadwalku'] = $this->seminar_model->get_jadwal($where);
		$this->load->view('user/sidang_jadwal',$data);
	}
}

/* End of file Magang.php */
?>
