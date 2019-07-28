<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function index()
    {
        // if($this->session->userdata('level')==='2'){
        $this->load->library('dompdf_gen');
        //$this->load->model('mrapat');
        $data['data'] = "Adiguna";
        //$data['cetak'] = $this->mrapat->get_cetak($kode_rapat);
        //print_r($data['notulen']);
        
        $html = $this->load->view('welcome_message',$data,true);
        $dompdf = new dompdf();
        $dompdf->set_paper('A4','portrait');
        //$dompdf->setPaper ('A4','potrait');
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Data_test.pdf', array("Attachment"=>0));
    }
}
    
    
