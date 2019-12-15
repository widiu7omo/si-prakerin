<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('seminar_model');
	}
}
