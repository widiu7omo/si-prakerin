<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps_prakerin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if ($this->session->userdata('level') != "admin"){
			redirect('sig/login');
		}
        $this->load->model('ini_user/Model_maps_perusahaan');
        //Do your magic here
    }
    
    public function index(){
        $maps = $this->Model_maps_perusahaan->tampil_perusahaan();
        $dataPerusahaan = array();
        foreach ($maps as $data_prusahaan) {
            if($data_prusahaan->lat_perusahaan != NULL && $data_prusahaan->long_perusahaan != NULL){
                $dataPerusahaan[] = array(
                    "name" =>$data_prusahaan->nama_perusahaan,
                    "lat" =>$data_prusahaan->lat_perusahaan,
                    "lng" =>$data_prusahaan->long_perusahaan,
                );
            }
        }
        $data = array(
            'form_nama' => 'Peta Perusahaan',
            'komponen'  => 'maps',
            'dataJSON'  => json_encode($dataPerusahaan, JSON_NUMERIC_CHECK),
        );
        $this->load->view('ini_user/header', $data);
        $this->load->view('ini_user/menu');
        $this->load->view('ini_user/view_maps_prakerin');
        $this->load->view('ini_user/footer', $data);
        
    }
}

?>