<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        // $this->load->model('Model_dashboard');
	    $this->load->helper('notification');
    }
    //dashboard admin
    public function index()
    {
//    	var_dump( $this->session->userdata());
        $this->load->view('admin/dashboard');
        
    }
    public function clearnotif(){
    	$users = $this->session->userdata('level');
	    clear_notification($users);
	    redirect(site_url($this->uri->segment(1)));
    }

}

/* End of file Dashboard.php */
 ?>