<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Foto extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    $this->load->model('ini_user/Model_foto');
    //Do your magic here
  }

  # Control Tampil Tebel foto
  public function index(){
    $data = array(
        'form_nama' => 'Data foto',
        'komponen'  => 'view',
        't_foto' => $this->Model_foto->tampil_foto(),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_foto');
    $this->load->view('ini_user/footer');
  }
  # Control Form Tambah foto
  public function tambah_foto(){  
    $data = array(
        'form_nama' => 'Tambah Data foto',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_foto');
    $this->load->view('ini_user/footer');
  }

  # Control Proses Tambah foto
  public function add_foto(){
    if(!empty($_FILES['file']['name'])){
      $nama_foto = $this->input->post("nama_foto");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().'_'.$nama_foto.'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $img = $this->upload->data();
        $data = array(
          'nama_foto' => $nama_foto,
          'deskripsi_foto' => $this->input->post("deskripsi_foto"),
          'tanggal_foto' => date("Y-m-d"),
          'data_foto' => $img['file_name'],
          'kategori_foto' => 'galeri',
        );
        $this->Model_foto->simpan_foto($data, FALSE);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Disimpan',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/foto');
      }
    }
  }
  
  # Control Form Edit foto
  public function edit_foto(){
    $id_foto = $this->uri->segment(4);
    $data = array(
        'form_nama'   => 'Ubah Data foto',
        'komponen'    => 'action',
        't_foto'  => $this->Model_foto->tampil_foto($id_foto),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_foto');
    $this->load->view('ini_user/footer');
  }

  public function update_foto(){
    # Control Proses Edit foto
    if(!empty($_FILES['file']['name'])){
      $id['id_foto']  = $this->input->post("id_foto");
      $nama_foto = $this->input->post("nama_foto");
      $deskripsi_foto = $this->input->post("deskripsi_foto");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().$nama_foto.'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $img = $this->upload->data();
        unlink(FCPATH."./file_upload/file_si/".$this->input->post("file_lama"));
        $data = array(
          'nama_foto'     => $nama_foto,
          'deskripsi_foto'=> $deskripsi_foto,
          'tanggal_foto'  => date("Y-m-d"),
          'data_foto'     => $img['file_name'],
        );
        $this->Model_foto->edit_foto($data, $id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Di Ubah',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/foto');
      }
    }else{
      $id['id_foto']  = $this->input->post("id_foto");
      $nama_foto = $this->input->post("nama_foto");
      $deskripsi_foto = $this->input->post("deskripsi_foto");
      $data = array(
        'nama_foto' => $nama_foto,
        'deskripsi_foto' => $deskripsi_foto,
        'tanggal_foto' => date("Y-m-d"),
      );
      $this->Model_foto->edit_foto($data, $id);
      # Data Untuk Membuat Notifikasi
      $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil',
        'ket_notif'     => 'Data Berhasil Di Ubah',
        'bg_color'      => '#29af12',
      );
      # Session Notifikasi
      $this->session->set_flashdata($data_notif);
      redirect('users/foto');
    }
  }

  public function hapus_foto(){
    # Control Proses Hapus foto
    $id['id_foto'] = $this->input->post('id_foto');
    unlink(FCPATH."./file_upload/file_si/".$this->input->post("file_foto"));
    $this->Model_foto->hapus_foto($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Menghapus',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/foto');
  }
}
?>