<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Pengajuan_model extends CI_Model {

	private $_table = 'tb_perusahaan_sementara';

	private $_primary_key = 'id_perusahaan_sementara';

	//add parameter here
	public $id_perusahaan_sementara = null;//auto increment
	public $nim;
	public $id_perusahaan;


	public function rules() {
		return [
			[
				'field' => 'id_perusahaan',
				'label' => 'ID Perusahaan',
				'rules' => 'required'
			],
		];
	}

	public function getAll( $select = null, $where = null, $join = null ) {
		if ( $select != null ) {
			$this->db->select( $select );
		}
		if ( $where != null ) {
			$this->db->where( $where );
		}
		if ( $join != null ) {
			$this->db->join( $join[0], $join[1], $join[2] );
		}

		return $this->db->get( $this->_table )->result();
	}

	public function getById( $id = null, $select = null, $join = null ) {
		if ( $select != null ) {
			$this->db->select( $select );
		}
		if ( $join != null ) {
			$this->db->join( $join[0], $join[1], $join[2] );
		}

		return $this->db->get_where( $this->_table, [ $this->_primary_key => $id ] )->row();
	}

	public function insert() {

		$post = $this->input->post();
		$this->nim = $this->session->userdata('id');
		$this->id_perusahaan = $post['id_perusahaan'];
		//id perusahaan sementara null (look at line 11)
		//add parameter here

		return $this->db->insert( $this->_table, $this );
	}

	public function update_multi($data,$where){
		//add parameter here
		return $this->db->update( $this->_table, $data, $where);
	}
	public function update() {
		$post = $this->input->post();
		$get = $this->input->get();
		$this->changeHere = $post['changeHere'];
		//add parameter here
		return $this->db->update( $this->_table, $this, [ $this->_primary_key => $post['changeHere'] ] );
	}

	public function delete( $id ) {
		return $this->db->delete( $this->_table, [ $this->_primary_key => $id ] );
	}

}

/* End of file changeHere_model.php */
?>