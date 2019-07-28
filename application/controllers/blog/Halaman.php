<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
        $this->load->model('blog/Model_halaman');
        $this->load->helper('tanggal_indo');
    }
    public function index(){
        echo "<script>window.history.back()</script>";
        die;
    }
    function detail_halaman($slug_kategori = FALSE){
        $data_halaman = $this->Model_halaman->tampil_halaman($slug_kategori)->row();
        if(empty($data_halaman)){
            echo "<script>window.history.back()</script>";
            die;
        }
        $data['form_nama'] = 'Halaman';
        $data['komponen']  = 'home';
        $data['t_halaman'] = $data_halaman;
        $this->load->view('blog/header', $data);
        $this->load->view('blog/menu');
        $this->load->view('blog/view_halaman');
        $this->load->view('blog/footer');
    }

}

?>