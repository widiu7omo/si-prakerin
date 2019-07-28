<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//change name to snake case
if ( ! function_exists('do_upload'))
{
    function do_upload(){
        $ci=& get_instance();
            $config['upload_path']          = './file_upload/';
            $config['allowed_types']        = 'xls|xlsx';
            $config['max_size']             = 10240;

            $ci->load->library('upload', $config);

            if ( ! $ci->upload->do_upload('file'))
            {
                $error = array('error' => $ci->upload->display_errors());
                // var_dump($error);
                return $error; 
                // $ci->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $ci->upload->data());
                // var_dump($data);
                return $data;
                // $ci->load->view('upload_success', $data);
            }
        }
}
if ( ! function_exists('do_upload_doc'))
{
	function do_upload_doc(){
		$ci=& get_instance();
		$config['upload_path']          = './file_upload/bukti/';
		$config['allowed_types']        = 'pdf|docx|doc';
		$config['max_size']             = 10240;

		$ci->load->library('upload', $config);

		if ( ! $ci->upload->do_upload('file'))
		{
			$error = array('error' => $ci->upload->display_errors());
			// var_dump($error);
			return $error;
			// $ci->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $ci->upload->data());
			// var_dump($data);
			return $data;
			// $ci->load->view('upload_success', $data);
		}
	}
}
?>