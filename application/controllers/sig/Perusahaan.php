<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perusahaan extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    $this->load->model('sig/Model_perusahaan');
    $this->load->helper('tanggal_indo');
    //Cek Session
    if ($this->session->userdata('level') != "mahasiswa"){
			redirect('sig/login');
		}
  }
  
  public function index(){
    //Mengirimkan Data Array Yang Akan Ditampilkan di View
    $data = array(
      'form_nama' => 'Data Perusahaan',
      'komponen'  => 'perusahaan',
    );
    $this->load->view('sig/header', $data);
    $this->load->view('sig/menu');
    $this->load->view('sig/view_perusahaan');
    $this->load->view('sig/footer');
  }

  public function detail_perusahaan($id_perusahaan = NULL){
    $detail_perusahaan = $this->Model_perusahaan->tampil_perusahaan($id_perusahaan);
    //Membuat Jeson Marker Maps
    foreach ($detail_perusahaan->result() as $data_prusahaan) {
      $dataPerusahaan[] = array(
        "id"=>$data_prusahaan->id_perusahaan,
        "name"=>$data_prusahaan->nama_perusahaan,
        "lat" =>$data_prusahaan->lat_perusahaan,
        "lng" =>$data_prusahaan->long_perusahaan,
      );
    }
    //Menampilkan Review Perusahaan
    $mhs_review = $this->Model_perusahaan->tampil_mhs_review($detail_perusahaan->row()->nama_perusahaan);
    $berkas_mhs_pilih_perusahaan = $this->Model_perusahaan->tampil_berkas_mhs_pilih_perusahaan($detail_perusahaan->row()->nama_perusahaan);
    $data_jumlah_mhs_review = $this->Model_perusahaan->tampil_jumlah_mhs_review($detail_perusahaan->row()->nama_perusahaan);
    
    //Mengirimkan Data Array Yang Akan Ditampilkan di View
    $data = array(
      'form_nama'     => 'Data Detail Perusahaan',
      'komponen'      => 'perusahaan',
      't_perusahaan'  => $detail_perusahaan->result(),
      'dataJSON'      => json_encode($dataPerusahaan, JSON_NUMERIC_CHECK),
      //'t_soal_kuesioner'    => $this->Model_perusahaan->tampil_soal_kuesioner(),
      't_mhs_review'        => $mhs_review,
      //'t_perusahaan_review' => json_encode($perusahaan_review_data, JSON_NUMERIC_CHECK),
      't_berkas_mhs_pilih_perusahaan' => $berkas_mhs_pilih_perusahaan,
      't_jumlah_mhs_review' => $data_jumlah_mhs_review,
    );
    $this->load->view('sig/header', $data);
    $this->load->view('sig/menu');
    $this->load->view('sig/view_detail_perusahaan');
    $this->load->view('sig/footer');
  }
  
}
?>