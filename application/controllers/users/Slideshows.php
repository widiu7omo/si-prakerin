<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slideshows extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    $this->load->model('ini_user/Model_slideshows');
    //Do your magic here
  }

  # Control Tampil Tebel slideshows
  public function index(){
    $data = array(
        'form_nama' => 'Data Slideshows',
        'komponen'  => 'view',
        't_slideshows' => $this->Model_slideshows->tampil_slideshows(),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_slideshows');
    $this->load->view('ini_user/footer');
  }
  # Control Form Tambah slideshows
  public function tambah_slideshows(){  
    $data = array(
        'form_nama' => 'Tambah Data Slideshows',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_slideshows');
    $this->load->view('ini_user/footer');
  }

  # Control Proses Tambah slideshows
  public function add_slideshows(){
    if(!empty($_FILES['file']['name'])){
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $img = $this->upload->data();
        $data = array(
          'tanggal_foto' => date("Y-m-d"),
          'data_foto' => $img['file_name'],
          'kategori_foto' => 'slideshows',
        );
        $this->Model_slideshows->simpan_slideshows($data, FALSE);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Disimpan',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/slideshows');
      }
    }
  }
  
  # Control Form Edit slideshows
  public function edit_slideshows($id_foto = FALSE){
    $data = array(
        'form_nama'   => 'Ubah Data Slideshows',
        'komponen'    => 'action',
        't_slideshows'  => $this->Model_slideshows->tampil_slideshows($id_foto),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_slideshows');
    $this->load->view('ini_user/footer');
  }

  public function update_slideshows(){
    # Control Proses Edit slideshows
    if(!empty($_FILES['file']['name'])){
      $id['id_foto']  = $this->input->post("id_foto");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $img = $this->upload->data();
        unlink(FCPATH."./file_upload/file_si/".$this->input->post("file_lama"));
        $data = array(
          'tanggal_foto'  => date("Y-m-d"),
          'data_foto'     => $img['file_name'],
        );
        $this->Model_slideshows->edit_slideshows($data, $id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Di Ubah',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/slideshows');
      }
    }else{
      $id['id_foto']  = $this->input->post("id_foto");
      $data['tanggal_slideshows'] = date("Y-m-d");
      $this->Model_slideshows->edit_slideshows($data, $id);
      # Data Untuk Membuat Notifikasi
      $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil',
        'ket_notif'     => 'Data Berhasil Di Ubah',
        'bg_color'      => '#29af12',
      );
      # Session Notifikasi
      $this->session->set_flashdata($data_notif);
      redirect('users/slideshows');
    }
  }

  public function hapus_slideshows(){
    # Control Proses Hapus slideshows
    $id['id_foto'] = $this->input->post('id_foto');
    unlink(FCPATH."./file_upload/file_si/".$this->input->post("file"));
    $this->Model_slideshows->hapus_slideshows($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Menghapus',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/slideshows');
  }
}
?>