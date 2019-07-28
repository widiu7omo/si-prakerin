<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Pilihperusahaan_model extends CI_Model {

	private $_table = 'tb_mhs_pilih_perusahaan';

	private $_primary_key = 'id_mhs_pilih_perusahaan';

	//add parameter here
	public $id_mhs_pilih_perusahaan = null;//auto increment
	public $nim;
	public $id_perusahaan;


	public function rules() {
		return [

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
			if ( is_array( $join[0] ) ) {
				foreach ( $join as $jo ) {
					$this->db->join( $jo[0], $jo[1], $jo[2] );
				}
			} else {
				$this->db->join( $join[0], $join[1], $join[2] );
			}
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

	public function insert($data = []) {
		if(count($data) > 0){
			$this->nim = $data['nim'];
			$this->id_perusahaan = $data['id_perusahaan'];

			return $this->db->insert( $this->_table, $this );
		}
		return false;
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