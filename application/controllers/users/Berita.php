<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Berita extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
        $this->load->model('ini_user/Model_berita');
        $this->load->helper('tanggal_indo');
    }
    
    public function index(){
        # Control Tampil Berita
        $data = array(
            'form_nama' => 'Data Berita',
            'komponen'  => 'view',
            't_berita' => $this->Model_berita->tampil_berita(),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_berita', $data, FALSE);
        $this->load->view('ini_user/footer');
    }

    public function tambah_berita(){
        # Control Tambah Berita
        $data = array(
            'form_nama' => 'Tambah Data Berita',
            'komponen'  => 'action',
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/tambah_berita');
        $this->load->view('ini_user/footer');
    }

    public function add_berita(){
        if(!empty($_FILES['file']['name'])){
            $nama_berita = $this->input->post("nama_berita");
            $konten_berita = $this->input->post("konten_berita");
            $temp = explode(".", $_FILES["file"]["name"]);
            $config['file_name'] = time().$nama_berita.'.'.end($temp);
            $config['upload_path'] = FCPATH."./file_upload/file_si";
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')){
                $img = $this->upload->data();
                $replace      = str_replace(" ", "-", $nama_berita);
                $lower        = strtolower($replace);
                $data = array(
                    'nama_berita'      => $nama_berita,
                    'slug_berita'      => $lower,
                    'konten_berita'    => $konten_berita,
                    'tanggal_berita'   => date("Y-m-d"),
                    'gambar_berita'    => $img['file_name'],
                );
                $this->Model_berita->simpan_berita($data, FALSE);
                # Data Untuk Membuat Notifikasi
                $data_notif = array(
                    'session_notif' => 'notif',
                    'judul_notif'   => 'Berhasil',
                    'ket_notif'     => 'Data Berhasil Disimpan',
                    'bg_color'      => '#29af12',
                );
                # Session Notifikasi
                $this->session->set_flashdata($data_notif);
                redirect('users/berita');
            }
        }
    }

    # Control Form Edit Berita
    public function edit_berita($id_berita = NULL){
        $data = array(
            'form_nama' => 'Ubah Data Berita',
            'komponen'  => 'action',
            't_berita'  => $this->Model_berita->tampil_berita($id_berita),
        );
        $this->load->view('ini_user/header', $data, FALSE);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/edit_berita');
        $this->load->view('ini_user/footer');
    }

    public function update_berita(){
        if(!empty($_FILES['file']['name'])){
            $id['id_berita']  = $this->input->post('id_berita');
            $nama_berita = $this->input->post("nama_berita");
            $konten_berita = $this->input->post("konten_berita");
            $temp = explode(".", $_FILES["file"]["name"]);
            $config['file_name'] = time().$nama_berita.'.'.end($temp);
            $config['upload_path'] = FCPATH."./file_upload/file_si";
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')){
                $img = $this->upload->data();
                unlink(FCPATH."./file_upload/img/".$this->input->post("file_lama"));
                $replace      = str_replace(" ", "-", $nama_berita);
                $lower        = strtolower($replace);
                $data = array(
                    'nama_berita'      => $nama_berita,
                    'slug_berita'      => $lower,
                    'konten_berita'    => $konten_berita,
                    'tanggal_berita'   => date("Y-m-d"),
                    'gambar_berita'    => $img['file_name'],
                );
                $this->Model_berita->edit_berita($data, $id);
                # Data Untuk Membuat Notifikasi
                $data_notif = array(
                    'session_notif' => 'notif',
                    'judul_notif'   => 'Berhasil',
                    'ket_notif'     => 'Data Berhasil Di Ubah',
                    'bg_color'      => '#29af12',
                );
                # Session Notifikasi
                $this->session->set_flashdata($data_notif);
                redirect('users/berita');
            }
        }else{
            $id['id_berita']  = $this->input->post('id_berita');
            $nama_berita = $this->input->post("nama_berita");
            $konten_berita = $this->input->post("konten_berita");
            $replace      = str_replace(" ", "-", $nama_berita);
            $lower        = strtolower($replace);
            $data = array(
                'nama_berita'      => $nama_berita,
                'slug_berita'      => $lower,
                'konten_berita'    => $konten_berita,
                'tanggal_berita'   => date("Y-m-d"),
            );
            $this->Model_berita->edit_berita($data, $id);
        
            # Data Untuk Membuat Notifikasi
            $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Data Berhasil Di Ubah',
            'bg_color'      => '#29af12',
            );
            # Session Notifikasi
            $this->session->set_flashdata($data_notif);
            redirect('users/berita');
        }
    }

    public function hapus_berita(){
        # Control Hapus Berita
        $id['id_berita'] = $this->input->post('id_berita');
        $this->Model_berita->hapus_berita($id);
        # Data Untuk Membuat Notifikasi
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Data Berhasil Menghapus',
            'bg_color'      => '#29af12',
        );
        # Session Notifikasi
        $this->session->set_flashdata($data_notif);
        redirect('users/berita');
    }
}
?>