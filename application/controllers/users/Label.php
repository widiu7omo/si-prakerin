<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    $this->load->model('ini_user/Model_label');
    //Do your magic here
  }

  # Control Tampil Tebel Label
  public function index(){
    $data = array(
        'form_nama' => 'Data Label',
        'komponen'  => 'view',
        't_label' => $this->Model_label->tampil_label(),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_label');
    $this->load->view('ini_user/footer');
  }

  # Control Form Tambah Label
  public function tambah_label(){  
    $data = array(
        'form_nama' => 'Tambah Data Label',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_label');
    $this->load->view('ini_user/footer');
  }

  # Control Proses Tambah Tag
  public function add_label(){
    $data = array(
      'id_label'        => NULL,
      'nama_label'      => $this->input->post("nama_label"),
    );
    $this->Model_label->simpan_label($data, FALSE);

    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Disimpan',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/label');
  }
  
  # Control Form Edit Tag
  public function edit_label($id_label = NULL){
    $id_label = $this->uri->segment(4);
    $data = array(
        'form_nama' => 'Edit Data Tag',
        'komponen'  => 'action',
        't_label'     => $this->Model_label->tampil_label($id_label),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_label');
    $this->load->view('ini_user/footer');
  }

  public function update_label(){
    # Control Proses Edit Tag
    $id['id_label'] = $this->input->post("id_label");
    $data = array(
      'nama_label'  => $this->input->post("nama_label"),
    );
    $this->Model_label->edit_label($data, $id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil DiEdit',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/label');
  }

  public function hapus_label(){
    # Control Proses Hapus Tag
    $id['id_label'] = $this->uri->segment(4);
    $this->Model_label->hapus_label($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Menghapus',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/label');
  }
}
?>