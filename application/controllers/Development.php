<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Development extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//Do your magic here
	}
	public function index()
	{
		$status['development'] = true;
		$this->load->view('under_development',$status);
	}

}

/* End of file Controllername.php */
?>