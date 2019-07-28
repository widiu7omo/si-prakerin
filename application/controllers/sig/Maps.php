<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maps extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('sig/Model_maps');
        //Do your magic here
    }
    
    public function index (){
      $maps = $this->Model_maps->tampil_perusahaan();
      $dataPerusahaan = array();
      foreach ($maps as $data_prusahaan) {
        if($data_prusahaan->lat_perusahaan != NULL && $data_prusahaan->long_perusahaan != NULL){
          $dataPerusahaan[] = array(
            "name"=>$data_prusahaan->nama_perusahaan,
            "lat" =>$data_prusahaan->lat_perusahaan,
            "lng" =>$data_prusahaan->long_perusahaan,
          );
        }
      }
      $data = array(
        'form_nama' => 'Map Perusahaan',
        'komponen'  =>'maps',
        'dataJSON'  => json_encode($dataPerusahaan, JSON_NUMERIC_CHECK),
      );
      $this->load->view('sig/header', $data);
      $this->load->view('sig/menu');
      $this->load->view('sig/view_maps');
      $this->load->view('sig/footer');
    }

    function get_autocomplete(){
      if (isset($_GET['term'])) {
        $result = $this->Model_maps->tampil_perusahaan($_GET['term']);
        if (count($result) > 0) {
          foreach ($result as $row)
            $arr_result[] = array(
            'label'	=> $row->nama_perusahaan,
          );
          echo json_encode($arr_result);
        }
      }
    }

    public function perusahaan_search(){
      $keyword=$this->input->get('keyword');
      $data['data'] = $this->blog_model->search_blog($keyword);
  
      $this->load->view('search_view',$data);
    }
}
?>