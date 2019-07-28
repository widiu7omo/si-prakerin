<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('prodi_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['prodies'] = $this->prodi_model->getAll();
        $this->load->view('admin/prodi',$data);
    }
    public function create(){
        $prodi = $this->prodi_model;
        $validation = $this->form_validation;
        $validation->set_rules($prodi->rules());
        if ($validation->run()) {
            $prodi->insert();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(current_url());
        }
        $this->load->view('admin/prodi_tambah');
    }
    public function edit($id = null){
        if (!isset($id)) redirect('prodi');
        $prodi = $this->prodi_model;
        $validation = $this->form_validation;
        $validation->set_rules($prodi->rules());
        if ($validation->run()) {
            $prodi->update();
            $this->session->set_flashdata('success', 'Berhasil dirubah');
        }
        $data['prodi'] = $prodi->getById($id);
        if (!$data['prodi']) show_404();
        $this->load->view('admin/prodi_edit', $data);
    }
    public function remove($id = null){
        if (!isset($id)) show_404();
        if ($this->prodi_model->delete($id)) {
            redirect(site_url('prodi'));
        }
    }
} ?>