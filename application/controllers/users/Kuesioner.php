<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
    //Do your magic here
    $this->load->model('ini_user/Model_kuesioner');
  }
  
  public function index(){
    # Control Tampil Kuesioner
    $data = array(
      'form_nama' => 'Soal Kriteria Ulasan',
      'komponen' => 'view',
      't_kuesioner' => $this->Model_kuesioner->tampil_kuesioner(),
    );
    $this->load->view('ini_user/header', $data);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/view_kuesioner');
    $this->load->view('ini_user/footer'); 
  }

  public function tambah_kuesioner(){
    # Control Tambah Perusahaa
    $data = array(
        'form_nama' => 'Tambah Soal Kriteria Ulasan',
        'komponen'  => 'action',
    );
    $this->load->view('ini_user/header', $data);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/tambah_kuesioner');
    $this->load->view('ini_user/footer');
  }

  public function add_kuesioner(){
    $soal_kuesioner = $this->input->post("soal_kuesioner");
    $data = array(
      'soal_kuisioner' => $soal_kuesioner,
      'id_jenis_kuisioner' => '10',
    );
    $this->Model_kuesioner->simpan_kuesioner($data, FALSE);

    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil Disimpan',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kuesioner');
  }

  public function edit_kuesioner($id_data_kuisioner = NULL){
    $data = array(
        'form_nama'   => 'Edit Keriteria Ulasan',
        'komponen'    => 'action',
        't_kuesioner'  => $this->Model_kuesioner->tampil_kuesioner($id_data_kuisioner),
    );
    $this->load->view('ini_user/header', $data, FALSE);
    $this->load->view('ini_user/menu');
    $this->load->view('ini_user/edit_kuesioner');
    $this->load->view('ini_user/footer');
  }

  public function update_kuesioner(){
    # Control Proses Edit Kategori
    $id['id_data_kuisioner']  = $this->input->post("id_soal_kuesioner");
    $data['soal_kuisioner']  = $this->input->post("soal_kuesioner");
    $this->Model_kuesioner->edit_kuesioner($data, $id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
      'session_notif' => 'notif',
      'judul_notif'   => 'Berhasil',
      'ket_notif'     => 'Data Berhasil DiEdit',
      'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kuesioner');
  }

  public function hapus_kuesioner(){
    # Control Hapus Halaman
    $id['id_data_kuisioner'] = $this->input->post('id_data_kuisioner');
    $this->Model_kuesioner->hapus_kuesioner($id);
    # Data Untuk Membuat Notifikasi
    $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil',
        'ket_notif'     => 'Data Berhasil Menghapus',
        'bg_color'      => '#29af12',
    );
    # Session Notifikasi
    $this->session->set_flashdata($data_notif);
    redirect('users/kuesioner');
}
}
?>