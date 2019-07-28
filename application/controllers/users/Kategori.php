<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    $this->load->model('ini_user/Model_kategori');
    //Do your magic here
  }
  
  # Control Tampil Tebel Kategori
  public function index(){
    $data = array(
        'form_nama' => 'Data Kategori Menu',
        'komponen'  => 'view',
        't_kategori' => $this->Model_kategori->tampil_kategori(),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_kategori');
    $this->load->view('ini_user/footer');
  }

  # Control Form Tambah Kategori
  public function tambah_kategori(){  
    $data = array(
        'form_nama' => 'Tambah Data Kategori Menu',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_kategori');
    $this->load->view('ini_user/footer');
  }

  # Control Proses Tambah Kategori
  public function add_kategori(){
    $nama_kategori = $this->input->post("nama_kategori");
    $replace    = str_replace(" ", "-", $nama_kategori);
    $lower      = strtolower($replace);
    $data = array(
      'id_kategori'   => NULL,
      'nama_kategori' => $nama_kategori,
      'slug_kategori' => $lower,
    );
    $this->Model_kategori->simpan_kategori($data, FALSE);

    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Disimpan',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kategori');
  }
  
  # Control Form Edit Kategori
  public function edit_kategori(){
    $kategori['id_kategori'] = $this->uri->segment(4);
    $data = array(
        'form_nama'   => 'Edit Data Kategori Menu',
        'komponen'    => 'action',
        't_kategori'  => $this->Model_kategori->tampil_kategori($kategori),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_kategori');
    $this->load->view('ini_user/footer');
  }

  public function update_kategori(){
    # Control Proses Edit Kategori
    $id['id_kategori']  = $this->input->post("id_kategori");
    $nama_kategori      = $this->input->post("nama_kategori");
    $replace    = str_replace(" ", "-", $nama_kategori);
    $lower      = strtolower($replace);
    $data = array(
      'nama_kategori'  => $nama_kategori,
      'slug_kategori'  => $lower,
    );
    $this->Model_kategori->edit_kategori($data, $id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil DiEdit',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kategori');
  }

  public function hapus_kategori(){
    # Control Proses Hapus Kategori
    $id['id_kategori'] = $this->uri->segment(4);
    $this->Model_kategori->hapus_kategori($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Menghapus',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kategori');
  }
}
?>