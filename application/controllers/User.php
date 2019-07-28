<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mahasiswa_model');
        $this->load->model('pegawai_model');
        $this->load->library('form_validation');
        $this->load->helper('notification');
        
    }
    //dashboard user
    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'SIG Perusahaan',
                    'href'=>'https://sig.prakerin.politala.ac.id',
                    'icon'=>'ni ni-square-pin',
                    'desc'=>'Sistem Informasi Pemetaan Mahasiswa yang melaksanakan Praktik Kerja Industri Politeknik Negeri Tanah Laut'),
                array('name'=>'Kuesioner Perusahaan',
                    'href'=>site_url('user/kuesioner?m=mhs'),
                    'icon'=>'ni ni-single-copy-04',
                    'desc'=>'Lakukan review tempat magangmu, supaya adik kelasmu memperoleh refensi bagus')
            );
            $data['mahasiswa'] = $this->mahasiswa_model->getById();
            break;
            case 'dosen':
            $data['menus'] = array(
                array('name'=>'Monev Prakerin',
                    'href'=>'https://monev.prakerin.politala.ac.id',
                    'desc'=>'Aplikasi monitoring tempat Praktik kerja lapangan'),
                array('name'=>'Kuesioner Dosen',
                    'href'=>site_url('kuesioner?m=dsn'),
                    'desc'=>'Kuesioner bagi dosen tentang bla bla bla')
            );
            $data['dosen'] = $this->pegawai_model->getById();
            break;
            default: $data['menus'] = []; redirect(site_url('main'));//@TODO:change this, clean code
        }
        $this->load->view('user/dashboard',$data);
    }
    public function profile(){
        $level = $this->session->userdata('level');
        $id = $this->session->userdata('id');
        switch($level){
            case 'mahasiswa':
            $data['profile'] = $this->mahasiswa_model->getById($id);
            break;
            case 'dosen':
            $data['profile'] = $this->pegawai_model->getById($id);
            break;
            default: $data['profile'] = null;
        }
        $this->load->view('user/profile',$data);
    }
    public function editprofile(){
        $level = $this->session->userdata('level');
        $id = $this->session->userdata('id');
        switch($level){
            case 'mahasiswa':
            if (!isset($id)) redirect('prodi');
            $mahasiswa = $this->mahasiswa_model;
            $validation = $this->form_validation;
            $validation->set_rules($mahasiswa->rules());
            if ($validation->run()) {
                $mahasiswa->update();
                update_notification('read','profil',$id);
                $this->session->set_flashdata('status', 'Berhasil dirubah');

            }
            else{
                $this->session->set_flashdata('status', 'Gagal Mengubah');
            }
            break;
            case 'dosen':
            $data['profile'] = $this->pegawai_model->getById($id);
            break;
            default: $data['profile'] = null;
        }
        redirect(site_url('user/profile'));
    }
    public function logout(){
        session_destroy();
        redirect(site_url('blog/home'));
    }
    public function login(){

    }
    public function create(){
        $changeHere = $this->changeHere;
        $validation = $this->form_validation;
        $validation->set_rules($changeHere->rules());
        if ($validation->run()) {
            $changeHere->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('changeHere');
    }
    public function edit($id = null){
        if (!isset($id)) redirect('changeHere');
        $changeHere = $this->changeHere;
        $validation = $this->form_validation;
        $validation->set_rules($changeHere->rules());
        
        if ($validation->run()) {
            $changeHere->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data['changeHere'] = $changeHere->getById($id);
        if (!$data['changeHere']) show_404();
        $this->load->view('changeHere', $data);
    }
    public function remove($id = null){
        if (!isset($id)) show_404();
        if ($this->changeHere->delete($id)) {
            redirect(site_url('changeHere'));
        }
    }
    public function kuesioner(){
        $get = $this->input->get();
        if(isset($get['m'])){
            $this->load->view('user/kuesioner');
        }
    }
} ?>
