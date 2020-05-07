<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['master', 'menu']);
		$this->load->model(['Kuesioner_model']);
	}

	public function simpan_bobot_ahp()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->insert_bobot_ahp()) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

	public function ambil_random_index()
	{
		$random_index = [
			['om' => 1, 'ri' => '0.00'],
			['om' => 2, 'ri' => '0.00'],
			['om' => 3, 'ri' => '0.58'],
			['om' => 4, 'ri' => '0.90'],
			['om' => 5, 'ri' => '1.12'],
			['om' => 6, 'ri' => '1.24'],
			['om' => 7, 'ri' => '1.32'],
			['om' => 8, 'ri' => '1.41'],
			['om' => 9, 'ri' => '1.45'],
			['om' => 10, 'ri' => '1.49'],
			['om' => 11, 'ri' => '1.51'],
			['om' => 12, 'ri' => '1.48'],
			['om' => 13, 'ri' => '1.56'],
			['om' => 14, 'ri' => '1.57'],
			['om' => 15, 'ri' => '1.59']
		];
		echo json_encode($random_index);
	}

	public function index_matriks_perbandingan()
	{
		$data = [];
		$kuesioner = $this->Kuesioner_model;
		$data['kriteria'] = $kuesioner->get_kriteria();
		$this->load->view('admin/kuesioner_mahasiswa_matriks', $data);
	}

	public function index_kuesioner_mahasiswa($data_only = false)
	{
		$data['rows'] = [];
		$kuesioner = $this->Kuesioner_model;
		if ($this->input->get('sec') == 'kriteria') {
			$data['rows'] = $kuesioner->get_kriteria();
			$data['master_level'] = masterdata('tb_master_level');
		}
		if ($this->input->get('sec') == 'pertanyaan') {
			$data['rows'] = $kuesioner->get_pertanyaan();
			$data['kriteria'] = $kuesioner->get_kriteria();
		}
		if ($this->input->get('sec') == 'bobot') {
			$data['rows'] = $kuesioner->get_bobot();
			$data['master_level'] = masterdata('tb_master_level');
		}
		if ($data_only) return $data;
		$this->load->view('admin/kuesioner_mahasiswa_atribut', $data);
	}

	public function insert_bobot()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->insert_bobot()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Bobot berhasil ditambahkan',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Bobot gagal ditambahkan',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=bobot');
	}

	public function update_bobot()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->update_bobot()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Bobot berhasil diedit',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Bobot gagal diedit',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=bobot');
	}

	public function delete_bobot()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->delete_bobot()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Bobot berhasil dihapus',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Bobot gagal dihapus',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=bobot');
	}

	public function get_bobot()
	{
		$get = $this->input->get();
		$kuesioner = $this->Kuesioner_model;
		$data = [];
		$data = $this->index_kuesioner_mahasiswa(true);
		if ($get['id']) {
			$data['bobot'] = $kuesioner->get_bobot($get['id']);
		}
		$this->load->view('admin/kuesioner_mahasiswa_atribut', $data);
	}

	public function insert_pertanyaan()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->insert_pertanyaan()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Pertanyaan berhasil ditambahkan',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Pertanyaan gagal ditambahkan',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=pertanyaan');
	}

	public function update_pertanyaan()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->update_pertanyaan()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Pertanyaan berhasil diedit',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Pertanyaan gagal diedit',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=pertanyaan');
	}

	public function delete_pertanyaan()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->delete_pertanyaan()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Pertanyaan berhasil dihapus',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Pertanyaan gagal dihapus',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=pertanyaan');
	}

	public function get_pertanyaan()
	{
		$get = $this->input->get();
		$kuesioner = $this->Kuesioner_model;
		$data = [];
		$data = $this->index_kuesioner_mahasiswa(true);
		if ($get['id']) {
			$data['pertanyaan'] = $kuesioner->get_pertanyaan($get['id']);
		}
		$this->load->view('admin/kuesioner_mahasiswa_atribut', $data);
	}

	public function insert_kriteria()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->insert_kriteria()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Kriteria berhasil ditambahkan',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Kriteria gagal ditambahkan',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=kriteria');
	}

	public function update_kriteria()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->update_kriteria()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Kriteria berhasil diedit',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Kriteria gagal diedit',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=kriteria');
	}

	public function delete_kriteria()
	{
		$kuesioner = $this->Kuesioner_model;
		if ($kuesioner->delete_kriteria()) {
			$this->session->set_flashdata('status', array(
				'message' => 'Sukses, Kriteria berhasil dihapus',
				'color' => 'success'
			));
		} else {
			$this->session->set_flashdata('status', array(
				'message' => 'Gagal, Kriteria gagal dihapus',
				'color' => 'danger'
			));
		}
		redirect('kuesioner?m=mahasiswa&sec=kriteria');
	}

	public function get_kriteria()
	{
		$get = $this->input->get();
		$kuesioner = $this->Kuesioner_model;
		$data = [];
		$data = $this->index_kuesioner_mahasiswa(true);
		if ($get['id']) {
			$data['kriteria'] = $kuesioner->get_kriteria($get['id']);
		}
		$this->load->view('admin/kuesioner_mahasiswa_atribut', $data);
	}

	public function hasil_kuesioner_mahasiswa()
	{
		$this->load->view('admin/kuesioner_mahasiswa_hasil');
	}

	public function jawaban_hasil()
	{
		$kuesioner = $this->Kuesioner_model;
		$res['data'] = $kuesioner->get_jawaban_responder();
		echo json_encode($res);
	}

	public function jawaban_rekap()
	{
		$kuesioner = $this->Kuesioner_model;
		$res['data'] = $kuesioner->get_rekap_responder();
		echo json_encode($res);
	}

	public function index()
	{
		$get = $this->input->get();
		if (isset($get['m'])) {
			switch ($get['m']) {
				case 'matriks':
					return $this->index_matriks_perbandingan();
					break;
				case 'mahasiswa':
					if (isset($get['sec']) and $get['sec'] == 'hasil') {
						return $this->hasil_kuesioner_mahasiswa();
					}
					if (isset($get['sec']) and $get['sec'] == 'rekap') {
						return $this->hasil_kuesioner_mahasiswa();
					}
					if (isset($get['sec']) and $get['sec'] == 'kriteria') {
						if (isset($get['q']) and $get['q'] == 'i') {
							return $this->insert_kriteria();
						}
						if (isset($get['q']) and $get['q'] == 'u') {
							return $this->update_kriteria();
						}
						if (isset($get['q']) and $get['q'] == 'd') {
							return $this->delete_kriteria();
						}
						if (isset($get['q']) and $get['q'] == 's') {
							return $this->get_kriteria();
						}
						return $this->index_kuesioner_mahasiswa();
					}
					if (isset($get['sec']) and $get['sec'] == 'pertanyaan') {
						if (isset($get['q']) and $get['q'] == 'i') {
							return $this->insert_pertanyaan();
						}
						if (isset($get['q']) and $get['q'] == 'u') {
							return $this->update_pertanyaan();
						}
						if (isset($get['q']) and $get['q'] == 'd') {
							return $this->delete_pertanyaan();
						}
						if (isset($get['q']) and $get['q'] == 's') {
							return $this->get_pertanyaan();
						}
						return $this->index_kuesioner_mahasiswa();
					}
					if (isset($get['sec']) and $get['sec'] == 'bobot') {
						if (isset($get['q']) and $get['q'] == 'i') {
							return $this->insert_bobot();
						}
						if (isset($get['q']) and $get['q'] == 'u') {
							return $this->update_bobot();
						}
						if (isset($get['q']) and $get['q'] == 'd') {
							return $this->delete_bobot();
						}
						if (isset($get['q']) and $get['q'] == 's') {
							return $this->get_bobot();
						}
						return $this->index_kuesioner_mahasiswa();
					}
					return $this->index_kuesioner_mahasiswa();
					break;
				case 'dosen':
					break;
				case 'perusahaan':
					break;
			}
		}
		$session = $this->session->userdata();
		!isset($session['level']) ? redirect('/') : null;
		if ($session['level'] == 'admin') {
			$data['menus'] = array(
				array(
					'name' => 'Pendefinsian Bobot SPK',
					'step_intro' => '1',
					'message_intro' => 'Matriks Perbandingan, Normalisasi, Validasi Bobot',
					'href' => site_url('kuesioner?m=matriks'),
					'icon' => 'fas fa-id-badge',
					'desc' => 'Pengelolaan nilai bobot terkait Matriks Perbandingan, Normalisasi, Validasi Bobot'
				),
				array(
					'name' => 'Atribut Kuesioner Perusahaan',
					'step_intro' => '3',
					'message_intro' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Perusahaan',
					'href' => site_url('kuesioner?m=perusahaan'),
					'icon' => 'fas fa-building',
					'desc' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Perusahaan'
				),
				array(
					'name' => 'Hasil Kuesioner Dosen',
					'step_intro' => '1',
					'message_intro' => 'Hasil Kuesioner dari responder Dosen yang telah mengisi kuesioner',
					'href' => site_url('kuesioner?m=dosen&sec=hasil'),
					'icon' => 'fas fa-id-badge',
					'desc' => 'Hasil Kuesioner dari responder Dosen yang telah mengisi kuesioner'
				),
				array(
					'name' => 'Atribut Kuesioner Dosen',
					'step_intro' => '1',
					'message_intro' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Dosen',
					'href' => site_url('kuesioner?m=dosen'),
					'icon' => 'fas fa-id-badge',
					'desc' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Dosen'
				),
				array(
					'name' => 'Atribut Kuesioner Mahasiswa',
					'step_intro' => '2',
					'message_intro' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Mahasiswa',
					'href' => site_url('kuesioner?m=mahasiswa'),
					'icon' => 'fas fa-star',
					'desc' => 'Pengelolaan Kuesioner, termasuk Kriteria, dan Pembobotan khusus Mahasiswa'
				),
				array(
					'name' => 'Hasil Kuesioner Mahasiswa',
					'step_intro' => '2',
					'message_intro' => 'Hasil Kuesioner dari responder Mahasiswa yang telah mengisi kuesioner',
					'href' => site_url('kuesioner?m=mahasiswa&sec=hasil'),
					'icon' => 'fas fa-star',
					'desc' => 'Hasil Kuesioner dari responder Mahasiswa yang telah mengisi kuesioner'
				),
				array(
					'name' => 'Hasil Kuesioner Perusahaan',
					'step_intro' => '2',
					'message_intro' => 'Hasil Kuesioner dari responder Perusahaan yang telah mengisi kuesioner',
					'href' => site_url('kuesioner?m=mahasiswa&sec=hasil'),
					'icon' => 'fas fa-star',
					'desc' => 'Hasil Kuesioner dari responder Perusahaan yang telah mengisi kuesioner'
				));
			$this->load->view('admin/kuesioner', $data);
		} else {
			$this->load->view('kuesioner/kuesioner_mahasiswa');
		}
	}

}

/* End of file Kuesioner.php */
