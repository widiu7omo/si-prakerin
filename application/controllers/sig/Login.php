<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('sig/Model_login');
    }
    
    public function index(){
        if (isset($_POST['PLogin'])) {
            $data['username'] = $this->input->post("username", TRUE);
            $password         = $this->input->post("password", TRUE);
            $data_login       = $this->Model_login->data_login($data['username']);
            $password_db      = $data_login->password;
            //Cek Kesesuaian Password DAN Membuat Session
            if(password_verify($password, $password_db)){
                $data_session = array(
                    'id'    => $data_login->username,
                    'prodi' => $data_login->id_program_studi,
                    'level' => $data_login->nama_master_level,
                );
                $this->session->set_userdata($data_session);     
                if($this->session->userdata('level') == 'admin'){
                    redirect('users/home');
                }elseif($this->session->userdata('level') == 'mahasiswa'){
                    $data_notif = array(
                        'session_notif' => 'notif',
                        'judul_notif'   => 'Berhasil',
                        'ket_notif'     => 'Masuk Sebagai <strong>'.$this->session->userdata('id').'</strong>',
                        'icon'          => 'success'
                    );
                    $this->session->set_flashdata($data_notif);
                    redirect('sig/prakerin');
                }
            }else{
                $data_notif = array(
                    'session_notif' => 'notif',
                    'judul_notif'   => 'Gagal',
                    'ket_notif'     => 'Nama Pengguna & Kata Sandi Salah',
                    'icon'          => 'error'
                );
                $this->session->set_flashdata($data_notif);
                redirect('sig/login');
            }   
        }else{
            $data = array(
                'form_nama' => 'Silahkan Masuk',
                'komponen'  => 'login',
            );
            $this->load->view('sig/header', $data);
            $this->load->view('sig/menu');
            $this->load->view('sig/view_login');
            $this->load->view('sig/footer');
        }
    }

    public function login_out() {
		$this->session->unset_userdata('id');
        $this->session->unset_userdata('prodi');
        $this->session->unset_userdata('level');
        $data_notif = array(
            'session_notif' => 'notif',
            'judul_notif'   => 'Berhasil',
            'ket_notif'     => 'Berhasil Keluar',
            'icon'          => 'success'
        );
        $this->session->set_flashdata($data_notif);
        redirect('sig/home');
	}
}
?>