<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    $this->load->model('ini_user/Model_file');
    //Do your magic here
  }

  # Control Tampil Tebel File
  public function index(){
    $data = array(
        'form_nama' => 'Data Berkas Unduh',
        'komponen'  => 'view',
        't_file' => $this->Model_file->tampil_file(),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_file');
    $this->load->view('ini_user/footer');
  }

  # Control Form Tambah File
  public function tambah_file(){  
    $data = array(
        'form_nama' => 'Tambah Data Berkas',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_file');
    $this->load->view('ini_user/footer');
  }

  # Control Proses Tambah File
  public function add_file(){
    if(!empty($_FILES['file']['name'])){
      $nama_file = $this->input->post("nama_file");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().$nama_file.'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'pdf|docx|xlsx|pptx';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $file = $this->upload->data();
        $data = array(
          'nama_file'      => $nama_file,
          'tanggal_file'   => date("Y-m-d"),
          'data_file'      => $file['file_name'],
        );
        $this->Model_file->simpan_file($data, FALSE);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Disimpan',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/file');
      }
    } 
  }
  
  # Control Form Edit File
  public function edit_file($id_file = NULL){
    $id_file = $this->uri->segment(4);
    $data = array(
        'form_nama' => 'Ubah Berkas Unduh',
        'komponen'  => 'action',
        't_file'     => $this->Model_file->tampil_file($id_file),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_file');
    $this->load->view('ini_user/footer');
  }

  public function update_file(){
    # Control Proses Edit File
    if(!empty($_FILES['file']['name'])){
      $id['id_file']  = $this->input->post('id_file');
      $nama_file = $this->input->post("nama_file");
      $temp = explode(".", $_FILES["file"]["name"]);
      $config['file_name'] = time().$nama_file.'.'.end($temp);
      $config['upload_path'] = FCPATH."./file_upload/file_si";
      $config['allowed_types'] = 'pdf|docx|xlsx|pptx';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('file')){
        $file = $this->upload->data();
        unlink(FCPATH."./file_upload/file_si/".$this->input->post("file_lama"));
        $data = array(
          'nama_file'      => $nama_file,
          'tanggal_file'   => date("Y-m-d"),
          'data_file'      => $file['file_name'],
        );
        $this->Model_file->edit_file($data, $id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
          'session_notif' => 'notif',
          'judul_notif'   => 'Berhasil',
          'ket_notif'     => 'Data Berhasil Di Ubah',
          'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/file');
      }
    }else{
      $id['id_file']  = $this->input->post('id_file');
      $nama_file = $this->input->post('nama_file');
      $data = array(
        'nama_file'      => $nama_file,
        'tanggal_file'   => date('Y-m-d'),
      );
      $this->Model_file->edit_file($data, $id);
  
      # Data Untuk Membuat Notifikasi
      $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil',
        'ket_notif'     => 'Data Berhasil Di Ubah',
        'bg_color'      => '#29af12',
      );
      # Session Notifikasi
      $this->session->set_flashdata($data_notif);
      redirect('users/file');
    }
  }

  public function hapus_file(){
    # Control Proses Hapus File
    $id['id_file'] = $this->input->post('id_file');
    unlink(FCPATH."./file_upload/file_si/".$this->input->post("file_lama"));
    $this->Model_file->hapus_file($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Menghapus',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/file');
  }

  public function update_status(){
    # Control Proses Hapus File
    $id['id_file'] = $this->input->post('id_file');
    $data['status_file'] = $this->input->post('status_file');
    $this->Model_file->update_status_file($data, $id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Status Berhasil di Ubah',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/file');
  }
}
?>
