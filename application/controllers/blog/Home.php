<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        //Do your magic here
        $this->load->model('blog/Model_home');
        $this->load->helper('tanggal_indo');
    }
    
    public function index (){
        $data = array(
            'form_nama' => 'Beranda',
            'komponen' =>'home',
            't_popular_post' => $this->Model_home->popular_post(),
            't_media'        => $this->Model_home->tampil_media(),
            't_media_slideshows' => $this->Model_home->tampil_media_slideshows(),
        );
        $this->load->view('blog/header', $data);
        $this->load->view('blog/menu');
        $this->load->view('blog/view_home');
        $this->load->view('blog/footer');
    }
}
?>