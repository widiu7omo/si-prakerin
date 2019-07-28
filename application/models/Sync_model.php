<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Sync_model extends CI_Model {

	private $_table = 'tb_pegawai';

	//add parameter here


	public function insert_or_replace( $akun, $level, $pegawai ) {
		$statusInsert = false;
		$this->db->trans_start();
		$this->db->replace( 'tb_akun', $akun );
		$this->db->replace( 'tb_level', $level );
		$this->db->replace( $this->_table, $pegawai );
		$this->db->trans_complete();
		//if status transaction complete, return true
		if ( $this->db->trans_status() != false ) {
			$statusInsert = true;
		}

		return $statusInsert;

	}

}

/* End of file suffix_model.php */ ?>