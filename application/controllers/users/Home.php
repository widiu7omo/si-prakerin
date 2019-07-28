<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
        //Do your magic here
    }
    
    public function index (){
        $data = array(
            'form_nama' => 'Beranda',
            'komponen' =>'home',
        );
        $this->load->view('ini_user/header', $data);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_home');
        $this->load->view('ini_user/footer');
    }
}
?>