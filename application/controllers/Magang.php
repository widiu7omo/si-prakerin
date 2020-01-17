<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('perusahaan_model', 'pengajuan_model', 'konsultasi_model', 'penilaian_model'));
		$this->load->helper(array('notification', 'master'));
		!$this->session->userdata('level') ? redirect(site_url('main')) : null;
		$id = $this->session->userdata('id');
		$mahasiswa = masterdata('tb_mahasiswa', array('nim' => $id), array(
			'alamat_mhs',
			'email_mhs',
			'jenis_kelamin_mhs'
		), false);
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
					array(
						'name' => 'Pengajuan Magang Perusahaan',
						'step_intro' => '1',
						'message_intro' => 'Pada menu ini, anda bisa mengajukan permohonan magang. Terdapat ratusan perusahaan yang bisa anda pilih untuk dijadikan tempat magang.',
						'href' => site_url('magang?m=pengajuan'),
						'icon' => 'fas fa-id-badge',
						'desc' => 'Ajukan pengajuan magang untuk memilih tempat magang yang diinginkan'
					),
					array(
						'name' => 'Pengajuan Perusahaan baru',
						'step_intro' => '2',
						'message_intro' => 'Bagi mahasiswa yang tidak bisa menemukan nama perusahaan pada saat proses pengajuan magang, anda bisa mengajukan perusahaan baru pada menu ini.',
						'href' => site_url('magang?m=perusahaanbaru'),
						'icon' => 'fas fa-star',
						'desc' => 'Pengajuan perusahaan baru, ketika pilihan perusahaan mahasiswa tidak tersedia'
					),
					array(
						'name' => 'Informasi Perusahaan',
						'step_intro' => '3',
						'message_intro' => 'Menu ini terintegrasi dengan aplikasi GIS prakerin, Jadi ketika anda menginput data pada aplikasi GIS, informasi tersebut akan dirangkum pada menu ini.',
						'href' => site_url('magang?m=perusahaan'),
						'icon' => 'fas fa-building',
						'desc' => 'Detail informasi terkait perusahaan tempat magang kalian'
					),
					array(
						'name' => 'Penilaian Perusahaan',
						'step_intro' => '4',
						'message_intro' => 'Penilaian ini adalah nilai yang diberikan oleh pembimbing lapangan kalian pada saat magang. Jadi pastikan bahwa data yang kalian input sudah benar atau belum.',
						'href' => site_url('magang?m=penilaian'),
						'icon' => 'fas fa-book',
						'desc' => 'Penilaian yang diperoleh dari tempat magang yang bersangkutan'
					),
				);
				break;
			case 'dosen':
				$data['menus'] = array(
					array(
						'name' => 'Monev Prakerin',
						'href' => 'https://monev.prakerin.politala.ac.id',
						'desc' => 'Aplikasi monitoring tempat Praktik kerja lapangan'
					),
					array(
						'name' => 'Kuesioner Dosen',
						'href' => site_url('kuesioner?m=dsn'),
						'desc' => 'Kuesioner bagi dosen tentang bla bla bla'
					)
				);
				break;
			default:
				show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server", 403, "Forbidden, you don't have pemission");
		}

		//get variable
		//sub menu, with crud
		$get = $this->input->get();
		if (isset($get['m'])) {
			switch ($get['m']) {
				case 'pengajuan':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->create_pengajuan();
					}
					if (isset($get['q']) && $get['q'] == 'u') {
						return $this->edit_pengajuan();
					}
					if (isset($get['q']) && $get['q'] == 'd') {
						return $this->remove_pengajuan();
					}

					return $this->index_pengajuan();

					break;
				case 'perusahaanbaru':
					if (isset($get['q']) && $get['q'] == 'i') {
						return $this->create_perusahaanbaru();
					}

					return $this->index_perusahaanbaru();
					break;
				case 'perusahaan':
					$post = $this->input->post();
					if (isset($post['insert'])) {
						$this->create_perusahaan($post);
					}
					if (isset($post['update'])) {
						$this->edit_perusahaan($post);
					}
					if (isset($post['delete'])) {
						$this->remove_perusahaan($post);
					}
					break;
				case 'penilaian':
					$get = $this->input->get();
					if (isset($get['q']) and $get['q'] == 'i') {
						return $this->create_penilaian();
					}
					if (isset($get['q']) and $get['q'] == 'u') {
						return $this->edit_penilaian();
					}
					if (isset($get['q']) and $get['q'] == 'd') {
						return $this->remove_penilaian();
					}
					return $this->index_penilaian();
					break;
				default:
					redirect(site_url('magang'));
			}
		}
		$this->load->view('user/magang', $data);

	}

	public function create_penilaian()
	{
		$penilaian = $this->penilaian_model;
		if ($penilaian->insert_penilaian_perusahaan()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function edit_penilaian()
	{
		$penilaian = $this->penilaian_model;
		if ($penilaian->update_penilaian_perusahaan()) {
			echo json_encode(array('status' => 'success'));
			return;
		}
		echo json_encode(array('status' => 'error'));
	}

	public function remove_penilaian()
	{
		$penilaian = $this->penilaian_model;
	}

	public function index_penilaian()
	{
		$bimbingan = $this->konsultasi_model;
		$penilaian = $this->penilaian_model;
		$perusahaan = $this->perusahaan_model;
		$cek_bimbingan = $bimbingan->check_bimbingan(true);
		if (isset($cek_bimbingan->id)) {
			$data['nilai_pkl'] = $penilaian->get_penilaian_perusahaan("id_dosen_bimbingan_mhs = '$cek_bimbingan->id'");
		}
		$data['bimbingan'] = $cek_bimbingan;
		$data['perusahaan_terpilih'] = $perusahaan->get_current_perusahaan();
		$this->load->view('user/magang_penilaian', $data);
	}

	public function index_pengajuan()
	{
		$level = $this->session->userdata('level');
		$prodi = $this->session->userdata('prodi');
		$get = $this->input->get();
		switch ($level) {
			case 'mahasiswa':
				//get data perusahaan based on prody and status
				$like = null;
				$select = array('id_perusahaan', 'nama_perusahaan', 'kuota_pkl');
				$where = array('status_perusahaan' => 'whitelist', 'id_program_studi' => $prodi);
				if (isset($get['q'])) {
					$like = array('nama_perusahaan' => $get['q']);
				}
				if (isset($get['status'])) {
					$get['status'] == 'decline' ? $this->decline_pengajuan() : null;
				}
				$perusahaans = $this->perusahaan_model->getAll($select, $where, null, $like);
				//filter perusahaan
				$nim = $this->session->userdata('id');
				$history_ditolak = masterdata('tb_history_pemilihan', "nim = '$nim'", 'id_perusahaan', true);
				foreach ($history_ditolak as $history) {
					foreach ($perusahaans as $index => $perusahaan) {
						if ($perusahaan->id_perusahaan === $history->id_perusahaan) {
							unset($perusahaans[$index]);
						}
					}
				}
				$data['perusahaans'] = $perusahaans;
				break;
			case 'prakerin':
				break;
			case 'koordinator prodi':
				break;
			default:
				$data['perusahaans'] = $this->perusahaan_model->getAll();
		}
		//intro
		$data['intro'] = array(
			array('step_intro' => 1, 'message_intro' => 'Ini adalah indikator status magang anda, hal ini berguna untuk mengetahui sampai mana proses pengajuan magang anda sedang berlangsung.'),
			array('step_intro' => 2, 'message_intro' => 'Ketik kata kunci kalian disini untuk mencari perusahaan yang anda inginkan'),
			array('step_intro' => 3, 'message_intro' => 'Kuota merupakan batas maksimal jumlah mahasiswa yang dapat magang pada perusahaan yang bersangkutan'),
			array('step_intro' => 4, 'message_intro' => 'Status adalah jumlah sementara yang sudah mengajukan magang pada perusahaan yang bersangkutan'),
			array('step_intro' => 5, 'message_intro' => 'Klik detail untuk melihat siapa saja yang magang pada perusahaan tersebut'),
			array('step_intro' => 6, 'message_intro' => 'Klik Ajukan untuk mengajukan pada perusahaan yang bersangkutan'));
		$this->load->view('user/magang_permohonan', $data);
	}

	public function decline_pengajuan()
	{
		$nim = $this->session->userdata('id');
		$id = $this->input->get('id');
//		array_push($history_perusahaan, $id);
		//id perusahaan
		if (isset($id)) {
			$where['id_perusahaan'] = $id;
			$data['status'] = 'tolak';
			$this->pengajuan_model->update_multi($data, $where);
			dynamic_insert('tb_history_pemilihan', array('nim' => $nim, 'id_perusahaan' => $id));
		}
		redirect(site_url('magang?m=pengajuan'));

	}

	public function create_pengajuan()
	{
		$post = $this->input->post();
		if (isset($post['insert'])) {
			$id = $this->session->userdata('id');
			$mahasiswa = masterdata('tb_mahasiswa', array('nim' => $id), 'nama_mahasiswa');
			$pengajuan = $this->pengajuan_model;
			if ($pengajuan->insert()) {
				$pesan = $mahasiswa->nama_mahasiswa . " ({$id})" . ' mengajukan permohonan magang';
				$uri = 'mahasiswa?m=pengajuan';
				set_notification($id, 'admin', $pesan, 'pengajuan magang', $uri);
				$this->session->set_flashdata('status', array(
					'message' => 'Pengajuan sedang diproses',
					'type' => 'success'
				));
			} else {
				$this->session->set_flashdata('status', array(
					'message' => 'Maaf, sementara ini belum bisa melakukan pengajuan',
					'type' => 'fail'
				));
			}
			redirect(site_url('magang?m=pengajuan'));
		}


	}

	public function edit_manajemen()
	{
		$id = $this->input->get('id');
		$post = $this->input->post();
		if (isset($post['update'])) {
			$perusahaan = $this->perusahaan_model;
			$validation = $this->form_validation;
			$validation->set_rules($perusahaan->rules());
			if ($validation->run() == false) {
				$this->session->set_flashdata('status', array(
					'message' => 'Gagal memvalidasi data',
					'type' => 'danger'
				));
			} else {
				$perusahaan->update() ?
					$this->session->set_flashdata('status', array(
						'message' => 'Data Perusahaan berhasil dirubah',
						'type' => 'success'
					)) :
					$this->session->set_flashdata('status', array(
						'message' => 'Data Perusahaan gagal dirubah',
						'type' => 'fail'
					));
			}
			redirect(site_url("magang?m=pengajuan&q=u&id={$id}"));
		}

		if (isset($id)) {
			$perusahaan = $this->perusahaan_model;
			$join = array(
				'tb_program_studi',
				'tb_perusahaan.id_program_studi = tb_program_studi.id_program_studi',
				'left outer'
			);
			$select = array('tb_perusahaan.*', 'tb_program_studi.nama_program_studi');
			$data['perusahaan'] = $perusahaan->getById($id, $select, $join);
		}

		$this->load->view('user/perusahaan_manajemen_edit', $data);
	}

	public function remove_manajemen()
	{
		$id = $this->input->get('id');
		if (!isset($id)) {
			show_404();
		}
		$this->perusahaan_model->delete($id) ?
			$this->session->set_flashdata('status', array(
				'message' => 'Data Perusahaan berhasil dihapus',
				'type' => 'success'
			)) :
			$this->session->set_flashdata('status', array(
				'message' => 'Data Perusahaan gagal dihapus',
				'type' => 'fail'
			));
		redirect(site_url('magang?m=pengajuan'));

	}

	public function index_perusahaanbaru()
	{
		//check,mahasiswa already have perusahaan or not
		$id = $this->session->userdata('id');
		$isExist = masterdata('tb_mhs_pilih_perusahaan', "nim = '$id'", 'nim', true);
		if (count($isExist) > 0) {
			$data['status'] = 'TIDAK TERSEDIA BAGI YANG SUDAH MEMPUNYAI TEMPAT MAGANG';

			return $this->load->view('user/not_available', $data);
		}
		$this->load->view('user/magang_perusahaan_baru');
	}

	public function create_perusahaanbaru()
	{
		$post = $this->input->post();
		$id = $this->session->userdata('id');
		//id = mahasiswa
		$data_mhs = masterdata('tb_mahasiswa', "nim = '$id'", 'nama_mahasiswa', false);
		$pesan = "Mahasiswa $data_mhs->nama_mahasiswa ($id) telah mengajukan perusahaan baru";
		$uri = 'perusahaan?m=manajemen';
//		@TODO:tambahi uri dan tes berhasil atau tidak.
		if (isset($post['insert'])) {
			$this->perusahaan_model->insert();
			set_notification($id, 'admin', $pesan, 'pengajuan magang', $uri);
			$this->session->set_flashdata('status', array(
				'message' => 'Data Pengajuan perusahaan berhasil disimpan',
				'type' => 'success'
			));
			redirect('magang?m=perusahaanbaru');
		}
		//set notification to admin
		//retrive prodi from session with key prodi

		redirect(site_url('magang?m=perusahaanbaru'));
	}

	public function create_perusahaan()
	{

	}

	public function edit_perusahaan()
	{

	}

	public function remove_perusahaan()
	{

	}

}

/* End of file Magang.php */
?>
