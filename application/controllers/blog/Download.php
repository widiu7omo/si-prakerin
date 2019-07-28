<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        //Do your magic here
        $this->load->model('blog/Model_download');
    }
    
    public function index (){
        $data = array(
            'form_nama' => 'Unduh Berkas',
            'komponen' =>'home',
            't_download' => $this->Model_download->tampil_download(),
        );
        $this->load->view('blog/header', $data);
        $this->load->view('blog/menu');
        $this->load->view('blog/view_download');
        $this->load->view('blog/footer');
    }
}
?>