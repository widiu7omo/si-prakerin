<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use Tools\FormGenerator;
require APPPATH.'libraries/FormGenerator.php';
class Perusahaan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('perusahaan_model');
	    $this->load->library( 'form_validation');
	    //middleware
        !$this->session->userdata('level')?redirect(site_url('main')):null;
    }
    
    public function index()
    {
        //menu dynamic
        $level = $this->session->userdata('level');
        switch($level){
            case 'admin':
            $data['menus'] = array(
                array('name'=>'Kelola Data Perusahaan',
                    'href'=>site_url('perusahaan?m=manajemen'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Pengelolaan data perusahaan'),
                array('name'=>'Informasi Perusahaan',
                    'href'=>site_url('perusahaan?m=informasi'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Detail informasi terkait perusahaan tempat magang kalian'),
                array('name'=>'Penilaian',
                    'href'=>site_url('perusahaan?m=penilaian'),
                    'icon'=>'fas fa-star',
                    'desc'=>'Penilaian yang diperoleh dari tempat magang yang bersangkutan')
            );
            break;
            //if there are not level except in case, it will throw to error with code 403
            default:show_error("Access Denied. You Do Not Have The Permission To Access This Page On This
            Server",403,"Forbidden, you don't have pemission");
        }
        //get variable
        //sub menu, with crud
        $get = $this->input->get();
        if(isset($get['m'])){
            switch($get['m']){
                case 'manajemen':
                	if(isset($get['q']) && $get['q'] == 'i'){
                		return $this->create_manajemen();
	                }
	                if(isset($get['q']) && $get['q'] == 'u'){
		                return $this->edit_manajemen();
	                }
	                if(isset($get['q']) && $get['q'] == 'd'){
		                return $this->remove_manajemen();
	                }
                	return $this->index_manajemen();

                break;
//              case bawah under development
                case 'informasi':
                    $post = $this->input->post();
                    if(isset($post['insert'])){
                        $this->create_informasi($post);
                    }
                    if(isset($post['update'])){
                        $this->edit_informasi($post);
                    }
                    if(isset($post['delete'])){
                        $this->remove_informasi($post);
                    }
                break;
                case 'penilaian':
                    $post = $this->input->post();
                    if(isset($post['insert'])){
                        $this->create_manajemen($post);
                    }
                    if(isset($post['update'])){
                        $this->edit_manajemen($post);
                    }
                    if(isset($post['delete'])){
                        $this->remove_manajemen($post);
                    }
                break;
                default:redirect(site_url('perusahaan'));
            }
        }
        
        $this->load->view('admin/perusahaan',$data);

    }
	public function index_manajemen(){
    	$level = $this->session->userdata('level');
    	switch ($level){
		    case 'admin':
		    	$join = ['tb_program_studi','tb_perusahaan.id_program_studi = tb_program_studi.id_program_studi','left outer'];
		    	$select = ['tb_perusahaan.*','tb_program_studi.nama_program_studi'];
			    $data['perusahaans'] = $this->perusahaan_model->getAll($select,null,$join);
		    	break;
		    case 'prakerin':
		    	break;
		    case 'koordinator prodi':
		    	break;
		    default:$data['perusahaans'] = $this->perusahaan_model->getAll();
	    }
		$this->load->view( 'admin/perusahaan_manajemen',$data);
	}
    public function create_manajemen(){
    	$post = $this->input->post();
    	if(isset($post['insert'])){
    		$perusahaan = $this->perusahaan_model;
    		$validation = $this->form_validation;
    		$validation->set_rules($perusahaan->rules());
    		if($validation->run() == false){
			    $this->session->set_flashdata( 'status', 'Gagal memvalidasi data' );
		    }
    		else{
			    $perusahaan->insert_batch()?
				    $this->session->set_flashdata( 'status', 'Data Perusahaan berhasil disimpan' ):
				    $this->session->set_flashdata( 'status', 'Data Perusahaan gagal disimpan' );
		    }
		    redirect(site_url('perusahaan?m=manajemen&q=i'));
	    }
	    $this->load->view( 'admin/perusahaan_manajemen_tambah');
    }
    public function edit_manajemen(){
	    $id = $this->input->get('id');
	    $post = $this->input->post();
	    if(isset($post['update'])){
		    $perusahaan = $this->perusahaan_model;
	    	$validation = $this->form_validation;
	    	$validation->set_rules($perusahaan->rules());
	    	if($validation->run() == false){
			    $this->session->set_flashdata( 'status', ['message'=>'Gagal memvalidasi data','type'=>'danger'] );
		    }
	    	else{
	    		$perusahaan->update()?
				    $this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan berhasil dirubah','type'=>'success'] ):
				    $this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan gagal dirubah','type'=>'fail']);
		    }
		    redirect(site_url("perusahaan?m=manajemen&q=u&id={$id}"));
	    }

	    if(isset( $id)){
		    $perusahaan = $this->perusahaan_model;
		    $join = ['tb_program_studi','tb_perusahaan.id_program_studi = tb_program_studi.id_program_studi','left outer'];
		    $select = ['tb_perusahaan.*','tb_program_studi.nama_program_studi'];
		    $data['perusahaan'] = $perusahaan->getById($id,$select,$join);
	    }

	    $this->load->view('admin/perusahaan_manajemen_edit',$data);
    }
    public function remove_manajemen(){
		$id = $this->input->get( 'id' );
	    if(!isset($id)) show_404();
	    $this->perusahaan_model->delete($id)?
		    $this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan berhasil dihapus','type'=>'success'] ):
		    $this->session->set_flashdata( 'status', ['message'=>'Data Perusahaan gagal dihapus','type'=>'fail']);
	    redirect(site_url('perusahaan?m=manajemen'));



    }
    public function create_informasi(){

    }
    public function edit_informasi(){

    }
    public function remove_informasi(){
        
    }
    public function create_penilaian(){

    }
    public function edit_penilaian(){

    }
    public function remove_penilaian(){
        
    }

}

/* End of file Magang.php */
 ?>