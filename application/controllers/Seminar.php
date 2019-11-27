<?php

use Tools\Excel;

require APPPATH . 'libraries/Excel.php';
defined('BASEPATH') OR exit('No direct script access allowed');

// Use upload Library and Excel library

class Seminar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('upload', 'master', 'notification'));
		$this->load->model(array('pembimbing_model', 'akun_model', 'pilihperusahaan_model', 'dosen_prodi_model', 'seminar_model'));
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
						'name' => 'Kelola Jadwal Sidang',
						'href' => site_url('seminar?m=kelola'),
						'icon' => 'fas fa-calendar-alt',
						'desc' => 'Pemilihan dosen berdasarkan program studi'
					),
					array(
						'name' => 'Kelola Pembimbing ' . $tahunAkademik[0]->tahun_akademik,
						'href' => site_url('dosen?m=pembimbing'),
						'icon' => 'fas fa-users',
						'desc' => 'Manajemen dosen pembimbing mahasiswa  ' . $tahunAkademik[0]->tahun_akademik
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
				default:
					redirect(site_url('seminar'));
			}
		}

		$this->load->view('admin/seminar', $data);
	}

	public function get_penguji()
	{
		return null;
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

		}
		return $this->load->view('admin/seminar_jadwal', $data);
	}

} ?>
