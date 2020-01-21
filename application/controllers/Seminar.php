<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('upload', 'master', 'notification'));
		$this->load->model(array('pembimbing_model', 'akun_model', 'penilaian_model', 'seminar_model', 'pilihperusahaan_model', 'dosen_prodi_model', 'seminar_model'));
		$this->load->library('form_validation');
		//middleware
		!$this->session->userdata('level') ? redirect(site_url('main')) : null;
	}

	public function index()
	{
		$join = array('tahun_akademik', 'tb_waktu.id_tahun_akademik = tahun_akademik.id_tahun_akademik', 'inner');
		$tahunAkademik = datajoin('tb_waktu', null, 'tahun_akademik.tahun_akademik', $join, null);
		$level = $this->session->userdata('level');
		switch ($level) {
			case 'admin':
				$data['menus'] = array(
					array(
						'name' => 'Kelola Jadwal Seminar Prakerin',
						'href' => site_url('seminar?m=kelola'),
						'icon' => 'fas fa-calendar-alt',
						'desc' => 'Pengolahan data jadwal untuk seminar meliputi penguji, tempat dan waktu'
					),
					array(
						'name' => 'Verifikasi Pendaftaran',
						'href' => site_url('seminar?m=pendaftaran'),
						'icon' => 'fas fa-calendar',
						'desc' => 'Verfikasi pendaftaran mahasiswa seminar 2 hari sebelum seminar dimulai'),
					array(
						'name' => 'Data Jadwal Seminar ' . $tahunAkademik[0]->tahun_akademik,
						'href' => site_url('seminar?m=data_jadwal'),
						'icon' => 'fas fa-file-excel',
						'desc' => 'Data jadwal terkini mahasiswa seminar  ' . $tahunAkademik[0]->tahun_akademik
					),
					array(
						'name' => 'Data Penilaian Seminar ' . $tahunAkademik[0]->tahun_akademik,
						'href' => site_url('seminar?m=data_penilaian'),
						'icon' => 'fas fa-file-excel',
						'desc' => 'Data penilaian seminar terkini  ' . $tahunAkademik[0]->tahun_akademik
					),
				);
				break;
			case 'koordinator prodi':
				$data['menus'] = array(
					array(
						'name' => 'Kelola Pembimbing ' . $tahunAkademik[0]->tahun_akademik,
						'href' => site_url('dosen?m=pembimbing'),
						'icon' => 'fas fa-users',
						'desc' => 'Manajemen dosen pembimbing mahasiswa  ' . $tahunAkademik[0]->tahun_akademik
					)
				);
				break;
			case 'mahasiswa':
				$post = $this->input->post();
				if (!isset($post['id'])) {
					show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server", 403, "Forbidden, you don't have pemission");
				}
				break;
			case 'dosen':
				$post = $this->input->post();
				if (!isset($post['id'])) {
					show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server", 403, "Forbidden, you don't have pemission");
				}
				break;
			//if there are not level except in case, it will throw to error with code 403
			default:
				show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server", 403, "Forbidden, you don't have pemission");
		}
		//get variable
		//sub menu, with crud
		$get = $this->input->get();
		if (isset($get['m'])) {
			switch ($get['m']) {
				case 'pendaftaran':
					return $this->index_verifikasi_pendaftaran();
					break;
				case 'kelola':
					if (isset($get['q']) && $get['q'] == 'u') {

					}
					if (isset($get['q']) && $get['q'] == 'd') {

					}
					return $this->index_kelola_jadwal();
					break;
				case 'tempat':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->add_tempat();
					}
					if (isset($get['q']) && $get['q'] == 'u') {
						return $this->update_tempat();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->delete_tempat();
					}
					return $this->get_tempat();
					break;
				case 'waktu':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->add_waktu();
					}
					if (isset($get['q']) && $get['q'] == 'u') {
						return $this->update_waktu();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->delete_waktu();
					}
					return $this->get_waktu();
					break;
				case 'tanggal':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->add_tanggal();
					}
					if (isset($get['q']) && $get['q'] == 'u') {
						return $this->update_tanggal();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->delete_tanggal();
					}
					return $this->get_tanggal();
					break;
				case 'penguji':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->add_penguji();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->delete_penguji();
					}
					if (isset($get['q']) && $get['q'] == 'i_bulk') {
						return $this->add_bulk_penguji();
					}
					if (isset($get['q']) && $get['q'] == 'd_bulk') {
						return $this->delete_bulk_penguji();
					}
					return $this->get_penguji();
					break;
				case 'mahasiswa':
					return $this->get_all_mhs_seminar();
					break;
				case 'jadwal':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->add_jadwal();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->delete_jadwal();
					}
					if (isset($get['q']) && $get['q'] == 'u') {
						return $this->update_jadwal();
					}
					return $this->get_jadwal();
					break;
				case 'data_jadwal':
					return $this->get_list_jadwal();
					break;
				case 'data_penilaian':
					return $this->get_list_penilaian();
					break;
				default:
					redirect(site_url('seminar'));
			}
		}

		$this->load->view('admin/seminar', $data);
	}
	public function index_verifikasi_pendaftaran(){
		$data = array();
		$this->load->view('admin/seminar_verifikasi_pendaftaran',$data);
	}
	public function get_list_penilaian()
	{
		$post = $this->input->post();
		$penilaian = $this->penilaian_model;
		$data_penilaian = $penilaian->get_penilaian_seminar();
		if (isset($post['ajax'])) {
			echo json_encode((object)array('data' => $data_penilaian));
			return;
		}
		$this->load->view('admin/seminar_list_penilaian');
	}

	public function get_list_jadwal()
	{
		$post = $this->input->post();
		$seminar = $this->seminar_model;
		$data_jadwal = $seminar->get_jadwal();
		if (isset($post['ajax'])) {
			echo json_encode((object)array('data' => $data_jadwal));
			return;
		}
		$this->load->view('admin/seminar_list_jadwal');
	}

	public function get_jadwal()
	{
		$seminar = $this->seminar_model;
		echo json_encode($seminar->get_jadwal());
	}

	public function add_jadwal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_jadwal()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function update_jadwal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->update_jadwal()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function delete_jadwal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_jadwal()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function get_all_mhs_seminar()
	{
		$seminar = $this->seminar_model;
		echo json_encode(array('data' => $seminar->get_all_mhs_seminar()));
	}

	public function get_penguji()
	{
		$status = isset($_GET['status']) ? $_GET['status'] : null;
		$seminar = $this->seminar_model;
		echo json_encode(array('data' => $seminar->get_all_penguji($status)));
	}

	public function add_penguji()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_penguji()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function add_bulk_penguji()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_bulk_penguji()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function delete_bulk_penguji()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_bulk_penguji()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function delete_penguji()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_penguji()) {
			echo json_encode(array('status' => 'success'));
			return;
		} else {
			echo json_encode(array('status' => 'error'));
			return;
		}
	}

	public function get_tempat()
	{
		$seminar = $this->seminar_model;
		echo json_encode(array('data' => $seminar->get_tempat_seminar()));
	}

	public function add_tempat()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_tempat_seminar()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
	}

	public function update_tempat()
	{
		$seminar = $this->seminar_model;
		if ($seminar->update_tempat_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function delete_tempat()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_tempat_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function get_waktu()
	{
		$seminar = $this->seminar_model;
		echo json_encode(array('data' => $seminar->get_waktu_seminar()));
	}

	public function add_waktu()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_waktu_seminar()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
	}

	public function update_waktu()
	{
		$seminar = $this->seminar_model;
		if ($seminar->update_waktu_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function delete_waktu()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_waktu_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function get_tanggal()
	{
		$seminar = $this->seminar_model;
		echo json_encode(array('data' => $seminar->get_tanggal_seminar()));
	}

	public function add_tanggal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->add_tanggal_seminar()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
	}

	public function update_tanggal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->update_tanggal_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function delete_tanggal()
	{
		$seminar = $this->seminar_model;
		if ($seminar->delete_tanggal_seminar()) {
			echo json_encode(array('status' => 'success'));
		}
	}

	public function index_kelola_jadwal()
	{
		$seminar = $this->seminar_model;
		$prodies = masterdata('tb_program_studi', null, '*');
		$data['prodies'] = $prodies;
		foreach ($prodies as $prodi) {
			$select = 'tb_dosen.id,tb_pegawai.nama_pegawai,tb_pegawai.nip_nik';
			$where = "id_program_studi = '$prodi->id_program_studi'";
			$join = array(
				array('tb_pegawai', 'tb_dosen.nip_nik = tb_pegawai.nip_nik', 'INNER'),
			);
			$dosens = datajoin('tb_dosen', $where, $select, $join);
			$data['dosens'][$prodi->id_program_studi] = $dosens;
			foreach ($dosens as $dosen) {
				$data['penguji'][$dosen->id] = masterdata('tb_seminar_penguji', "id_dosen = $dosen->id", '*', true, 'status');
			}
			$data['tempat'] = $seminar->count_tempat();
			$data['waktu'] = $seminar->count_waktu();
			$data['penguji_1'] = $seminar->count_penguji('p1');
			$data['penguji_2'] = $seminar->count_penguji('p2');
		}
		return $this->load->view('admin/seminar_jadwal', $data);
	}

} ?>
