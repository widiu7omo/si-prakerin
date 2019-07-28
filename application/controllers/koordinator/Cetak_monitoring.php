<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_monitoring extends CI_Controller {

    function __construct(){
        parent::__construct();
        if($this->session->userdata('nama_master_level') != "admin"){
            $this->session->sess_destroy();
            echo '<script language="javascript">alert("Akses Di Tolak!");';
            echo 'document.location="'.site_url('login').'";</script>';
        }       
        $this->load->model('koordinator/Mcetak_monitoring');
        $this->load->model('koordinator/Mmahasiswa');
    }

	public function cetak()
    {
        // if($this->session->userdata('level')==='2'){
        $this->load->library('dompdf_gen');
        //$this->load->model('mrapat');
        $data['data'] = "Adiguna";
        //$data['cetak'] = $this->mrapat->get_cetak($kode_rapat);
        //print_r($data['notulen']);
        
        $html = $this->load->view('koordinator/monitoring/cetak',$data,true);
        $dompdf = new dompdf();
        $dompdf->set_paper('L','portrait');
        //$dompdf->setPaper ('A4','potrait');
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Data_test.pdf', array("Attachment"=>0));
    }

    public function cetak_perdata()
    {
        $no_surat = $this->input->get('no_surat');

        $data['data_cetak'] = $this->Mcetak_monitoring->get_cetak_monitoring($no_surat);
        
        $this->load->view('koordinator/monitoring/cetak_perdata',$data);
    }

    public function cetak_semua_data()
    {

        $data['data_cetak'] = $this->Mcetak_monitoring->get_cetak_monitoring2();
        $x = count($this->input->post('tanggal_dari'));
        for ($i=1; $i <= $x; $i++) { 
            $this->load->view('koordinator/monitoring/cetak_semua_data',$data);
        }
    }
}
    
    
