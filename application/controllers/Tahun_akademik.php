<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_akademik extends CI_Controller {//change class
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tahunakademik_model');
        $this->load->library('form_validation');
        $this->load->helper('master');
    }
    public function index()
    {
        $data['tahunakademiks'] = $this->tahunakademik_model->getAll();// add S
        $this->load->view('admin/tahunakademik',$data);
    }
    public function create(){
        $tahunakademik = $this->tahunakademik_model;
        $validation = $this->form_validation;
        $validation->set_rules($tahunakademik->rules());
        if ($validation->run()) {
            $tahunakademik->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(current_url());
        }
        $this->load->view('admin/tahunakademik_tambah');
    }
    public function edit($id = null){
        if (!isset($id)) redirect('tahunakademik');
        $tahunakademik = $this->tahunakademik_model;
        $validation = $this->form_validation;
        $validation->set_rules($tahunakademik->rules());
        if ($validation->run()) {
            $tahunakademik->update();
            $this->session->set_flashdata('success', 'Berhasil dirubah');
        }
        $data['tahunakademik'] = $tahunakademik->getById($id);
        if (!$data['tahunakademik']) show_404();
        $this->load->view('admin/tahunakademik_edit', $data);
    }
    public function remove($id = null){
        if (!isset($id)) show_404();
        if ($this->tahunakademik_model->delete($id)) {
            redirect(site_url('tahunakademik'));
        }
    }
    public function set(){
        $currentTahun = getCurrentTahun();
        if(count($currentTahun) > 1) show_404();
        if($this->tahunakademik_model->update_waktu()){
            redirect(site_url('tahunakademik'));
        }
    }
} ?>