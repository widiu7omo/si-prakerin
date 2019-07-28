<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Review_perusahaan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
        }
        $this->load->model('ini_user/Model_review_perusahaan');
    }
    
    public function index(){
        # Control Tampil Perusahaa
        $data = array(
            'form_nama' => 'Data Perusahaan',
            'komponen' => 'view',
            't_review_perusahaan' => $this->Model_review_perusahaan->review_perusahaan(),
        );
        $this->load->view('ini_user/header', $data);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_review_perusahaan');
        $this->load->view('ini_user/footer');
    }

}
?>