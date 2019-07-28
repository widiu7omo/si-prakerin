<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
        }
        $this->load->model('ini_user/Model_perusahaan');
    }
    
    public function index(){
        # Control Tampil Perusahaa
        $data = array(
            'form_nama' => 'Data Perusahaan',
            'komponen' => 'view',
            't_perusahaan' => $this->Model_perusahaan->tampil_perusahaan(),
        );
        $this->load->view('ini_user/header', $data);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_perusahaan');
        $this->load->view('ini_user/footer');
    }

    public function tambah_perusahaan(){
        # Control Tambah Perusahaa
        $data = array(
            'form_nama' => 'Tambah Data Perusahaan',
            'komponen'  =>'action',
        );
        $this->load->view('ini_user/header', $data);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/tambah_perusahaan');
        $this->load->view('ini_user/footer');
    }

    public function add_perusahaan(){
        # Control Proses Tambah Perusahaa
        $data = array(
            'nama_perusahaan'   => $this->input->post("nama_perusahaan"),
            'long_perusahaan'   => $this->input->post("lng"),
            'lat_perusahaan'    => $this->input->post("lat"),
            'telepon_perusahaan'=> $this->input->post("no_telepon"),
            'alamat_perusahaan' => $this->input->post("alamat"),
        );
        $this->Model_perusahaan->simpan_perusahaan($data, FALSE);

        # Data Untuk Membuat Notifikasi
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Data Berhasil Disimpan',
            'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/perusahaan');
    }

    public function edit_perusahaan($id_perusahaan = NULL){
        # Control Edit Perusahaan
        $data = array(
            'form_nama' => 'Edit Data Perusahaan',
            'komponen' =>'action',
            't_perusahaan' => $this->Model_perusahaan->tampil_perusahaan($id_perusahaan),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/edit_perusahaan');
        $this->load->view('ini_user/footer');
    }

    public function update_perusahaan(){
        # Control Proses Edit Perusahaan
        $not_id['nama_perusahaan'] = $this->input->post("not_id");
        $data = array(
            'nama_perusahaan'   => $this->input->post("nama_perusahaan"),
            'long_perusahaan'   => $this->input->post("lng_perusahaan"),
            'lat_perusahaan'    => $this->input->post("lat_perusahaan"),
            'telepon_perusahaan'=> $this->input->post("telepon_perusahaan"),
            'alamat_perusahaan' => $this->input->post("alamat_perusahaan"),
        );
        $this->Model_perusahaan->edit_perusahaan($data, $not_id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Berhasil Mengupdate Data Perusahaan',
            'bg_color'      => '#29af12',
        );
        $this->session->set_flashdata($data_notif);
        redirect('users/perusahaan');
    }

    public function hapus_perusahaan(){
        # Control Hapus Perusahaan
    }
}
?>