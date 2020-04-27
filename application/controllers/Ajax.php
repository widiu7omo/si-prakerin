<?php defined('BASEPATH') OR exit('No direct script access allowed');

//use Tools\Excel;

//require APPPATH . 'libraries/Excel.php';

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('prodi_model', 'pengajuan_model', 'konsultasi_model'));
		$this->load->library('form_validation');
		$this->load->helper(array('upload', 'master', 'notification'));
	}

	public function initImport()
	{
		$data = do_upload('file');
		echo json_encode(array('status' => 'success'));

	}

	public function check_bimbingan()
	{
		$konsultasi = $this->konsultasi_model;
		$data = $konsultasi->check_bimbingan();
		echo json_encode(array('data' => $data));
	}

	public function remove_bimbingan()
	{
		$file = './file_upload/bimbingan/' . $_POST['file_name'];
		$konsultasi = $this->konsultasi_model;
		$status = $konsultasi->remove_bimbingan($_POST['file_name']);
		if ((is_readable($file) && unlink($file)) and $status) {
			echo json_encode(array('status' => "The file has been deleted"));
		} else {
			echo json_encode(array('status' => "The file was not found or not readable and could not be deleted"));
		}
	}

	public function remove_bukti()
	{
		$file = './file_upload/bukti/' . $_POST['file_name'];
		$id = $_POST['id_perusahaan'];
		$pengajuan = $this->pengajuan_model;
		$pengajuan->update_multi(array('bukti_diterima' => NULL, 'status' => 'kirim'), array('id_perusahaan' => $id));
		if (is_readable($file) && unlink($file)) {
			echo json_encode(array('status' => "The file has been deleted"));
		} else {
			echo json_encode(array('status' => "The file was not found or not readable and could not be deleted"));
		}
	}

	public function simpan_bukti(){
		$post = $this->input->post();
		$nim = $this->session->userdata('id');
		$pengajuan = $this->pengajuan_model;
		foreach ($post['mahasiswa'] as $mhs){
			$data_mhs = masterdata('tb_mahasiswa', "nim = '{$mhs['value']}'", 'nama_mahasiswa', false);
			if($mhs['status'] == "true"){
				$pengajuan->update_multi(array('status'=>'pending'),array('id_perusahaan'=>$post['id'],'nim'=>$mhs['value']));
				set_notification($nim, 'admin', "{$data_mhs->nama_mahasiswa} ({$mhs['value']}) telah mengirim bukti penerimaan magang", 'bukti diterima', 'mahasiswa?m=pengajuan');
			}
			else{
				$pengajuan->update_multi(array('status'=>'tolak'),array('id_perusahaan'=>$post['id'],'nim'=>$mhs['value']));
				set_notification($nim, 'admin', "{$data_mhs->nama_mahasiswa} ({$mhs['value']}) telah ditolak oleh perusahaan yang bersangkutan", 'bukti diterima', 'mahasiswa?m=pengajuan');
				dynamic_insert('tb_history_pemilihan', array('nim' => $mhs['value'], 'id_perusahaan' => $post['id']));
			}
		}
		echo json_encode(array('status'=>'success'));
//		if($pengajuan->update_multi(array('status'=>'pending'),array('id_perusahaan'=>$post['id']))){
//			set_notification($nim, 'admin', "{$mhs->nama_mahasiswa} ({$nim}) telah mengirim bukti penerimaan magang", 'bukti diterima', 'mahasiswa?m=pengajuan');
//			echo json_encode(array('status'=>'success'));
//		}
//		else{
//			echo json_encode(array('status'=>'error'));
//		}
	}
	public function upload_bimbingan()
	{
		$data = do_upload_bimbingan();
		$konsultasi = $this->konsultasi_model;
		if ($konsultasi->upload_bimbingan($data['upload_data']['file_name'])) {
			$data = array('status' => 'success', 'data' => $data);
		} else {
			$data = array('status' => 'error', 'data' => 'Failed to upload bimbingan');
		}
		echo json_encode($data);
	}

	public function init_files(){
		echo json_encode(masterdata('tb_perusahaan_sementara',array('nim'=>$_POST['nim']),"id_perusahaan as id,bukti_diterima as name,(select 'application/pdf' as type) as type"));
	}
	public function uploadbukti()
	{
		$id = $this->input->get('id');
		$data = do_upload_doc('file');
		if (isset($data['upload_data'])) {
			$file = $data['upload_data'];
			$this->pengajuan_model->update_multi(array('bukti_diterima' => $file['full_path'], 'status' => 'kirim'), array('id_perusahaan' => $id));
			//inject full path
			echo json_encode(array('status' => 'success', 'file_name' => $file['file_name'],'id'=>$id));
		} else {
			$file = $data['error'];
			$this->output->set_status_header(400);
			echo json_encode(array('status' => $file));
		}
	}

}
