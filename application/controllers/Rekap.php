<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('seminar_model');
		$this->load->helper('master');
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
						'name' => 'Mahasiswa Perusahaan',
						'href' => site_url('rekap?m=perusahaan'),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Mengisi data perusahaan, upload penilaian perusahaan'
					),
					array(
						'name' => 'Mahasiswa Bimbingan',
						'href' => site_url('rekap?m=bimbingan'),
						'icon' => 'fas fa-user-graduate',
						'desc' => 'Bimbingan dengan dosen, pengajuan judul, pengajuan seminar'
					),
					array(
						'name' => "Mahasiswa Seminar",
						'href' => site_url('rekap?m=seminar'),
						'icon' => 'fas fa-chalkboard-teacher',
						'desc' => 'Status seminar, Penilaian Seminar'
					),
					array(
						'name' => "Penilaian Keseluruhan",
						'href' => site_url('rekap?m=penilaian'),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Penilaian seminar, termasuk penilaian revisi'
					),
					array(
						'name' => "Mahasiswa selesai PKL",
						'href' => site_url('rekap?m=finishing'),
						'icon' => 'fas fa-exchange-alt',
						'desc' => 'Kelengkapan berkas, upload dokumen, persyaratan selesai PKL'
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

	}


}
