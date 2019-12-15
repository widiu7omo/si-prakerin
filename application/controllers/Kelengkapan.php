<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelengkapan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('kelengkapan_model', 'penilaian_model'));
		$this->load->helper('upload');
		! $this->session->userdata( 'level' ) ? redirect( site_url( 'main' ) ) : null;
	}

	public function index()
	{
		$level = $this->session->userdata('level');
		if (isset($_GET['m'])) {
			switch ($_GET['m']) {
				case 'upload':
					return $this->upload_berkas();
					break;
				default:
					redirect(site_url('kelengkapan'));
			}
		}
		$this->load->view('user/kelengkapan_berkas');
	}

	public function upload_berkas()
	{
		$res = do_upload_berkas();
		$nim = $this->session->userdata('id');
		$file_name = isset($res['upload_data']['file_name']) ? $res['upload_data']['file_name'] : null;
		$dsn_bimbingan = masterdata('tb_dosen_bimbingan_mhs', "nim = '$nim'", 'id_dosen_bimbingan_mhs id');
		$is_exits = masterdata('tb_kelengkapan_berkas', "id_dosen_bimbingan_mhs = '$dsn_bimbingan->id'", 'id');
		if ($is_exits == null) {
			$id = isset($is_exits->id)?$is_exits->id:null;
			if($this->db->query("REPLACE INTO tb_kelengkapan_berkas VALUES('$id','$dsn_bimbingan->id','$file_name')")){
				echo $this->db->insert_id();
			}
			else{
				show_error('failed upload',500);
			}
		}

//		var_dump($res);
	}
}
