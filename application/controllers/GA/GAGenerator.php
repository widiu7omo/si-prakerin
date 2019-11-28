<?php defined('BASEPATH') OR exit('No direct script access allowed');

use GeneticAlgorithm\Main;

require APPPATH . 'libraries/GeneticAlgorithm/Main.php';

class GAGenerator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('seminar_model','pembimbing_model'));
	}
	public function index(){
		$seminar = $this->seminar_model;
		$pembimbing = $this->pembimbing_model;
		$komponent_kromosom_1 = $pembimbing->get_all_approved_judul();
		$tempat = $seminar->get_tempat_seminar();
		$waktu = $seminar->get_waktu_seminar();
		$penguji_1 = $seminar->get_all_penguji('p1');
		$penguji_2 = $seminar->get_all_penguji('p2');
		echo "Banyak kemungkinan kombinasi komponen 2 adalah :".count($tempat)*count($waktu)*count($penguji_1)*count($penguji_2);
//		echo json_encode($pembimbing->get_all_approved_judul(),JSON_PRETTY_PRINT);
	}
}
