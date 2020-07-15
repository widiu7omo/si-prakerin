<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('seminar_model','tahunakademik_model'));
		$this->load->helper('master');
		! $this->session->userdata( 'level' ) ? redirect( site_url( 'main' ) ) : null;
	}

	public function index()
	{
		$level = $this->session->userdata('level');
		switch ($level) {
			case 'admin':
				$data['menus'] = array(
					array(
						'name' => 'Mahasiswa Magang dengan status',
						'href' => site_url('rekap?m=magang_status'),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Mahasiswa yang berhak magang yang telah memiliki tempat magang'
					),
					array(
						'name' => 'Mahasiswa Bimbingan',
						'href' => site_url('rekap?m=bimbingan'),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Bimbingan dengan dosen, pengajuan judul, pengajuan seminar'
					),
					array(
						'name' => "Mahasiswa Seminar dan Revisi",
						'href' => site_url('rekap?m=seminar'),
						'icon' => 'fas fa-chalkboard-teacher',
						'desc' => 'Daftar mahasiswa yang melakukan seminar dan revisi'
					),
					array(
						'name' => "Penilaian Akhir Keseluruhan",
						'href' => site_url('rekap?m=penilaian'),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Data Penghitungan nilai akhir dari perusahaan dan seminar'
					),
					array(
						'name' => "Mahasiswa Selesai PKL",
						'href' => site_url('rekap?m=finishing'),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Data mahasiswa yang telah menyelesaikan prakerin dan seminar prakerin'
					),
					array(
						'name' => "Mahasiswa Belum Lulus",
						'href' => site_url('rekap?m=belum_lulus'),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Data mahasiswa yang menyelesaikan PKL dari beberapa kategori'
					),
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
				case 'magang_status':
					return $this->index_magang_status();
					break;
				case 'perusahaan':
					return $this->index_perusahaan();
					break;
				case 'bimbingan':
					return $this->index_bimbingan();
					break;
				case 'seminar':
					return $this->index_seminar();
					break;
				case 'penilaian':
					return $this->index_penilaian();
					break;
				case 'finishing':
					return $this->index_finishing();
					break;
				case 'belum_lulus':
					return $this->index_belumfinishing();
					break;
				default:
					redirect(site_url('rekap'));
			}
		}
		$this->load->view('admin/rekap', $data);
	}

	public function index_magang_status()
	{
		$post = $this->input->post();
		$data = array();
		$join = array(
			array('tb_program_studi tp', 'tp.id_program_studi = tm.id_program_studi', 'inner'),
			array('tb_mhs_pilih_perusahaan pilih', 'pilih.nim = tm.nim', 'left outer')
		);
		$where_belum = 'pilih.nim is null';
		$where_sudah = 'pilih.nim is not null';
		$where_prodi = '';

		if(isset($post['prodi']) and $post['prodi'] != 'all'){
			$where_sudah .= " AND tp.id_program_studi = '$post[prodi]'";
			$where_belum .= " AND tp.id_program_studi = '$post[prodi]'";
			$where_prodi .= "id_program_studi = '$post[prodi]'";
		}
		$belum = datajoin('(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tm', $where_belum, 'tm.*,tp.nama_program_studi,0 as status', $join);
		$sudah = datajoin('(select tm.*,tw.`id_tahun_akademik` as id_ta from tb_mahasiswa tm join tb_waktu tw on tm.id_tahun_akademik =tw.id_tahun_akademik) tm', $where_sudah, 'tm.*,tp.nama_program_studi,1 as status ', $join);

		$data['mahasiswas'] = array_merge($belum, $sudah);
		$data['sudah'] = count($sudah);
		$data['belum'] = count($belum);
		$data['prodies'] = masterdata('tb_program_studi', $where_prodi, 'id_program_studi,nama_program_studi',true);
		if (isset($post['ajax'])) {
			echo json_encode(array('data' => $data['mahasiswas'],'chart'=>array('sudah'=>$data['sudah'],'belum'=>$data['belum'])));
			return;
		}
		$this->load->view('admin/rekap_magang_status', $data);
	}

	public function index_perusahaan()
	{

	}

	public function index_bimbingan()
	{

	}

	public function index_seminar()
	{

	}

	public function index_penilaian()
	{

	}

	public function index_finishing()
	{
		$data['ta'] = array();
		$data['mahselesai'] = array();
		$sem_model = $this->seminar_model;
		$ta_model= $this->tahunakademik_model;
		
		$data['ta'] = $ta_model->getAll();

		$id_ta = isset($_GET['filta']) ? $_GET['filta'] : null;

		if ($id_ta) {
			$data['mahselesai'] = $sem_model->get($id_ta, true);
		} else {
			$data['mahselesai'] = $sem_model->get(null, true);
		}
		$this->load->view('admin/rekap_mahselesai', $data);
	}

	public function index_belumfinishing()
	{
		$data['ta'] = array();
		$data['mahbelumselesai'] = array();
		$sem_model = $this->seminar_model;
		$ta_model= $this->tahunakademik_model;
		
		$data['ta'] = $ta_model->getAll();

		$id_ta = isset($_GET['filta']) ? $_GET['filta'] : null;

		if ($id_ta) {
			$data['mahbelumselesai'] = $sem_model->geta($id_ta, true);
		} else {
			$data['mahbelumselesai'] = $sem_model->geta(null, true);
		}
		$this->load->view('admin/rekap_mahbelumselesai', $data);
	}


}
