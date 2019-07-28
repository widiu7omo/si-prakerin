<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('level') != "mahasiswa"){
            redirect('sig/login');
        }
        $this->load->model('sig/Model_profile');
    }
    
    public function index(){
        $nim = $this->session->userdata('id');
        $data_mahasiswa = $this->Model_profile->tampil_mahasiswa($nim);
        // Tampil Data Mahasiswa
        $data = array(
            'form_nama'  => 'Informasi Profil',
            'komponen'   => 'prakerin',
            'nim'        => $data_mahasiswa->nim,
            'nama_mahasiswa'     => $data_mahasiswa->nama_mahasiswa,
            'nama_program_studi' => $data_mahasiswa->nama_program_studi,
            'alamat_mhs'         => $data_mahasiswa->alamat_mhs,
            'jenis_kelamin_mhs'  => $data_mahasiswa->jenis_kelamin_mhs,
            'email_mhs'          => $data_mahasiswa->email_mhs,
            'tempat_lahir_mhs'   => $data_mahasiswa->tempat_lahir_mhs,
            'tanggal_lahir_mhs'  => $data_mahasiswa->tempat_lahir_mhs,
            'no_hp_mahasiswa'    => $data_mahasiswa->no_hp_mahasiswa,
        );
        $this->load->view('sig/header', $data);
        $this->load->view('sig/menu');
        $this->load->view('sig/view_profile');
        $this->load->view('sig/footer');
    }

    public function ubah_foto_profil(){
        
    }
}

?>