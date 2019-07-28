<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        //Do your magic here
        $this->load->model('blog/Model_berita');
        $this->load->helper('tanggal_indo');
    }
    
    public function index(){
        $data = array(
            'form_nama' => 'Berita',
            'komponen' => 'home',
            't_berita' => $this->Model_berita->tampil_berita()->result(),
            't_popular_post' => $this->Model_berita->popular_post_berita(),
        );
        $this->load->view('blog/header', $data);
        $this->load->view('blog/menu');
        $this->load->view('blog/view_berita');
        $this->load->view('blog/footer');
    }

    function detail($slug_berita = NULL){
        $t_berita_view = $this->Model_berita->tampil_berita($slug_berita)->row();
        $data = array(
            'form_nama' => 'Detail Berita',
            'komponen' => 'home',
            'gambar_berita' => $t_berita_view->gambar_berita,
            'nama_berita'   => $t_berita_view->nama_berita,
            'konten_berita' => $t_berita_view->konten_berita,
            'tanggal_berita' => tgl_indo($t_berita_view->tanggal_berita),
            't_popular_post' => $this->Model_berita->popular_post_berita(),

        );
        $this->load->view('blog/header', $data);
        $this->load->view('blog/menu');
        $this->load->view('blog/view_berita');
        $this->load->view('blog/footer');
    }
}
?>