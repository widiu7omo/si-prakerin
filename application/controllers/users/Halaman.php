<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Halaman extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
        //Do your magic here
        $this->load->model('ini_user/Model_halaman');
        $this->load->model('ini_user/Model_kategori');
        $this->load->helper('tanggal_indo');
    }
    
    public function index(){
        # Control Tampil Perusahaa
        $data = array(
            'form_nama' => 'Data Halaman',
            'komponen'  => 'view',
            't_halaman' => $this->Model_halaman->tampil_halaman(),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_halaman', $data, FALSE);
        $this->load->view('ini_user/footer');
    }

    public function tambah_halaman(){
        # Control Tambah Perusahaa
        $data = array(
            'form_nama' => 'Tambah Data Halaman',
            'komponen'  => 'action',
            't_kategori' => $this->Model_halaman->tampil_kategori(),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/tambah_halaman');
        $this->load->view('ini_user/footer');
    }

    public function add_halaman(){
        # Control Proses Tambah Perusahaa
        $nama_halaman = $this->input->post("nama_halaman");
        $id_kategori = $this->input->post("id_kategori");
        $konten_halaman = $this->input->post("konten_halaman");
        $replace      = str_replace(" ", "-", $nama_halaman);
        $lower        = strtolower($replace);
        $data = array(
            'tanggal_halaman'   => date("Y-m-d"),
            'nama_halaman'      => $nama_halaman,
            'slug_halaman'      => $lower,
            'id_kategori'       => $id_kategori,
            'konten_halaman'    => $konten_halaman,
        );
        $this->Model_halaman->simpan_halaman($data, FALSE);

        # Data Untuk Membuat Notifikasi
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Data Berhasil Disimpan',
            'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/halaman');
    }

    # Control Form Edit Halaman
    public function edit_halaman($id_halaman = NULL){
        $data = array(
            'form_nama' => 'Ubah Data Halaman',
            'komponen'  => 'action',
            't_halaman'     => $this->Model_halaman->tampil_halaman($id_halaman),
            't_kategori'    => $this->Model_kategori->tampil_kategori(),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/edit_halaman');
        $this->load->view('ini_user/footer');
    }

    public function update_halaman(){
        # Control Proses Edit Tag
        $id['id_halaman'] = $this->input->post("id_halaman");
        $nama_halaman = $this->input->post("nama_halaman");
        $id_kategori = $this->input->post("id_kategori");
        $konten_halaman = $this->input->post("konten_halaman");
        $replace      = str_replace(" ", "-", $nama_halaman);
        $lower        = strtolower($replace);
        $data = array(
            'tanggal_halaman'   => date("Y-m-d"),
            'nama_halaman'      => $nama_halaman,
            'slug_halaman'      => $lower,
            'id_kategori'       => $id_kategori,
            'konten_halaman'    => $konten_halaman,
        );
        $this->Model_halaman->edit_halaman($data, $id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
        'session_notif' => 'notif',
        'judul_notif'   => 'Berhasil',
        'ket_notif'     => 'Data Berhasil Di Ubah',
        'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/halaman');
    }

    public function hapus_halaman(){
        # Control Hapus Halaman
        $id['id_halaman'] = $this->input->post('id_halaman');
        $this->Model_halaman->hapus_halaman($id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Data Berhasil Menghapus',
            'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/halaman');
    }
}
?>