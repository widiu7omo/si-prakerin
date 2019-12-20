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
				$treewalker = new TreeWalker(array("debug"=>true,"returntype"=>"jsonstring"));
				$differences = $treewalker->getdiff($server_kepegawaian,json_encode($local_kepegawaian),true);
				echo $differences;
			}
//			redirect( site_url( 'sync' ) );
		}
//		$this->load->view('admin/sync');
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
