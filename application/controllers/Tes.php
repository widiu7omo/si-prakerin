<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

use Tools\FormGenerator;
use Tools\WordGenerator;

require( APPPATH . 'libraries/FormGenerator.php' );
require( APPPATH . 'libraries/WordGenerator.php' );

class Tes extends CI_Controller {

	public function index() {
		$options       = array(
			array( 'name' => 'Zebra', 'value' => 'zebra' ),
			array( 'name' => 'Lion', 'value' => 'lion' )
		);
		$formGenerator = new FormGenerator();
		$formGenerator->initialize( 'perusahaan', 'form-group', 'select', null, $options );
		echo $formGenerator->result();
		$formGenerator = new FormGenerator();
		$formGenerator->initialize( 'radio', 'form-group', 'text', 'password', null );
		echo $formGenerator->result();

	}

	public function docx() {
		$wordGen = new WordGenerator;
		$wordGen->create_surat( 'magang' );
	}

	public function get_dosen_pembimbing() {
		echo json_encode($this->db->get( 'tb_dosen_bimbingan_mhs' )->result());
	}

}

/* End of file Tes.php */
?>