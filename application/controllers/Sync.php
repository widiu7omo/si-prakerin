<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/lukascivil/treewalker/src/TreeWalker.php';

class Sync extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('master');
		$this->load->model(array('sync_model', 'pegawai_model'));
	}


	public function index()
	{
		$get = $this->input->get();
		$pegawai = $this->pegawai_model;
		$result = array();
		if (isset($get['do'])) {
			$key = file_get_contents('https://kepegawaian.politala.ac.id/.key.text');
			if ($key != "") {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://kepegawaian.politala.ac.id/json_pegawai.php");
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,
					"key=$key");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$server_kepegawaian = curl_exec($ch);
				curl_close($ch);
				$local_kepegawaian = $pegawai->get_for_sync('nip_nik');

//				echo $server_output;
//				echo json_encode($local_kepegawaian);
//				echo json_encode($local_kepegawaian);
//				echo $server_kepegawaian;
				$treewalker = new TreeWalker(array("debug" => true, "returntype" => "jsonstring"));
				$differences = $treewalker->getdiff($server_kepegawaian, json_encode($local_kepegawaian), true);
//				echo $differences;
				$decode_diff = json_decode($differences);
				if (count($decode_diff->new) > 0) {
					$new_datas = $decode_diff->new;
					foreach ($new_datas as $data) {
						$data->no_hp_pegawai = "-";
					}
					if($pegawai->insert_batch($new_datas)){
						$this->session->set_flashdata('status',(object)array('status'=>'success','message'=>'Data berhasil disikronkan','type'=>'success'));
					}
					else{
						$this->session->set_flashdata('status',(object)array('status'=>'error','message'=>'Data gagal disikronkan','type'=>'danger'));
					}
				}
				if (count((array)$decode_diff->removed) > 0) {
					$this->session->set_flashdata('status',(object)array('status'=>'success','message'=>'Data belum tervalidasi, ON DEVELOPMENT','type'=>'warning'));
				}
				if (count((array)$decode_diff->edited) > 0) {
					$this->session->set_flashdata('status',(object)array('status'=>'success','message'=>'Data belum tervalidasi, ON DEVELOPMENT','type'=>'warning'));
//					$this->session->set_flashdata('status',(object)array('status'=>'success','message'=>'Data berhasil disikronkan','type'=>'success'));
				}
			}
			redirect(site_url('sync'));
		}
		$this->load->view('admin/sync', $result);
	}

	public function set_pegawai()
	{
		//insert into akun
		$objectPegawais = json_decode(json_encode($this->pegawais));
		$this->akun_model->insert_batch($objectPegawais, 'pegawai', array());
		echo json_encode(array('status' => 'success import data pegawai'));
		//insert into pegawai
		//insert into level
	}

	public function retrive_pegawai()
	{
		//  fetcing data from another database
		//	$config['hostname'] = 'localhost';
		//	$config['username'] = 'myusername';
		//	$config['password'] = 'mypassword';
		//	$config['database'] = 'mydatabase';
		//	$config['dbdriver'] = 'mysqli';
		//	$config['dbprefix'] = '';
		//	$config['pconnect'] = FALSE;
		//	$config['db_debug'] = TRUE;
		//	$this->load->model( 'nama_model','',$config );
	}
}
