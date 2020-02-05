<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//change name to snake case
if (!function_exists('do_upload')) {
	function do_upload()
	{
		$ci =& get_instance();
		$config['upload_path'] = './file_upload/';
		$config['allowed_types'] = 'xls|xlsx';
		$config['max_size'] = 10240;

		$ci->load->library('upload', $config);

		if (!$ci->upload->do_upload('file')) {
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		} else {
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
if (!function_exists('do_upload_doc')) {
	function do_upload_doc()
	{
		$ci =& get_instance();
		$config['upload_path'] = './file_upload/bukti/';
		$config['allowed_types'] = 'pdf|docx|doc';
		$config['max_size'] = 10240;

		$ci->load->library('upload', $config);

		if (!$ci->upload->do_upload('file')) {
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		} else {
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
if (!function_exists('do_upload_bimbingan')) {
	function do_upload_bimbingan()
	{
		$ci =& get_instance();
		$config['upload_path'] = './file_upload/bimbingan/';
		$config['allowed_types'] = 'pdf|zip|rar';
		$config['max_size'] = 512;
		$config['encrypt_name'] = TRUE;
		$ci->load->library('upload', $config);

		if (!$ci->upload->do_upload('file')) {
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		} else {
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
if (!function_exists('do_upload_berkas')) {
	function do_upload_berkas()
	{
		$ci =& get_instance();
		$config['upload_path'] = './file_upload/berkas/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 2560;
		$config['encrypt_name'] = FALSE;
		$ci->load->library('upload', $config);

		if (!$ci->upload->do_upload('filepond')) {
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		} else {
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
if (!function_exists('do_upload_pendaftaran_seminar')) {
	function do_upload_pendaftaran_seminar()
	{
		$ci =& get_instance();
		$config['upload_path'] = './file_upload/pendaftaran_seminar/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 2048;
		$config['encrypt_name'] = FALSE;
		$ci->load->library('upload', $config);

		if (!$ci->upload->do_upload('filepond')) {
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		} else {
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
?>
