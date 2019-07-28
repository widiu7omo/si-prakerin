<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('sig/Model_home');
        //Do your magic here
    }
    
    public function index($not_id = NULL){
        if(isset($_POST['title'])){
            $maps = $this->Model_home->tampil_perusahaan($_POST['title']);
        }else{
            $maps = $this->Model_home->tampil_perusahaan();
        }
        $dataPerusahaan = array();
        foreach ($maps->result() as $data_prusahaan) {
            if($data_prusahaan->lat_perusahaan != NULL && $data_prusahaan->long_perusahaan != NULL){
                $dataPerusahaan[] = array(
                "id"    =>$data_prusahaan->id_perusahaan,
                "name"  =>$data_prusahaan->nama_perusahaan,
                "alamat"=>$data_prusahaan->alamat_perusahaan,
                "lat"   =>$data_prusahaan->lat_perusahaan,
                "lng"   =>$data_prusahaan->long_perusahaan,
            );
            }
        }
        $data = array(
            'form_nama' => 'Peta Perusahaan',
            'komponen'  => 'home',
            'dataJSON'  => json_encode($dataPerusahaan, JSON_NUMERIC_CHECK),
        );
        $this->load->view('sig/header', $data);
        $this->load->view('sig/menu');
        $this->load->view('sig/view_home');
        $this->load->view('sig/footer');
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
        $result = $this->Model_home->list_perusahaan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                $arr_result[] = array(
                    'label'	=> $row->nama_perusahaan,
                );
            echo json_encode($arr_result);
            }
        }
    }
}
?>