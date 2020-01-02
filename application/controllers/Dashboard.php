<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        // $this->load->model('Model_dashboard');
	    $this->load->helper(array('notification','master'));
		! $this->session->userdata( 'level' ) ? redirect( site_url( 'main' ) ) : null;
    }
    //dashboard admin
    public function index()
    {
//    	var_dump( $this->session->userdata());
        $this->load->view('admin/dashboard');
        
    }
    public function clearnotif(){
    	$users = $this->session->userdata('level');
    	$penerima = '';
    	switch ($users){
			case 'mahasiswa':
				$penerima = $this->session->userdata('id');
				break;
			case 'admin':
				$penerima = $users;
				break;
		}
	    clear_notification($penerima);
	    redirect(site_url());
    }

}

/* End of file Dashboard.php */
 ?>
