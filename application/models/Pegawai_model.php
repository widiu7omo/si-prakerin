<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

    private $_table = 'tb_pegawai';

    private $_primary_key = 'nip';
    public $nip;
    public $username;
    public $id_status_pkl;
    public $id_pangkat_golongan;
    public $nama_pegawai;
    public $alamat_pegawai;
    public $jk_pegawai;
    public $email_pegawai;
    public $tempat_lahir_pegawai;
    public $tanggal_lahir_pegawai;
    public $no_hp_pegawai;
  
    //add parameter here

    public function rules(){
        return[
            [ 
                'field'=>'nip',
                'label'=>'nip',
                'rules'=>'required'
            ],
            [ 
                'field'=>'username',
                'label'=>'username',
                'rules'=>'required'
            ],
            [ 
                'field'=>'id_status_pkl',
                'label'=>'id_status_pkl',
                'rules'=>'required'
            ],
            [ 
                'field'=>'id_pangkat_golongan',
                'label'=>'id_pangkat_golongan',
                'rules'=>'required'
            ],
            [ 
                'field'=>'nama_pegawai',
                'label'=>'nama_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'alamat_pegawai',
                'label'=>'alamat_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'jk_pegawai',
                'label'=>'jk_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'email_pegawai',
                'label'=>'email_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'tempat_lahir_pegawai',
                'label'=>'tempat_lahir_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'tanggal_lahir_pegawai',
                'label'=>'tanggal_lahir_pegawai',
                'rules'=>'required'
            ],
            [ 
                'field'=>'no_hp_pegawai',
                'label'=>'no_hp_pegawai',
                'rules'=>'required'
            ],
        ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table,[$this->_primary_key=>$id])->row();
    }

    public function insert(){

        $post = $this->input->post();
        $this->nip = $post['nip'];
        $this->username = $post['username'];
        $this->id_status_pkl = $post['id_status_pkl'];
        $this->id_pangkat_golongan = $post['id_pangkat_golongan'];
        $this->nama_pegawai = $post['nama_pegawai'];
        $this->alamat_pegawai = $post['alamat_pegawai'];
        $this->jk_pegawai = $post['jk_pegawai'];
        $this->email_pegawai = $post['email_pegawai'];
        $this->tempat_lahir_pegawai = $post['tempat_lahir_pegawai'];
        $this->tanggal_lahir_pegawai = $post['tanggal_lahir_pegawai'];
        $this->no_hp_pegawai = $post['no_hp_pegawai'];
        //add parameter here
        $this->db->insert($this->_table,$this);
    }

    public function update(){
        $post = $this->input->post();

        $this->nip = $post['nip'];
        $this->username = $post['username'];
        $this->id_status_pkl = $post['id_status_pkl'];
        $this->id_pangkat_golongan = $post['id_pangkat_golongan'];
        $this->nama_pegawai = $post['nama_pegawai'];
        $this->alamat_pegawai = $post['alamat_pegawai'];
        $this->jk_pegawai = $post['jk_pegawai'];
        $this->email_pegawai = $post['email_pegawai'];
        $this->tempat_lahir_pegawai = $post['tempat_lahir_pegawai'];
        $this->tanggal_lahir_pegawai = $post['tanggal_lahir_pegawai'];
        $this->no_hp_pegawai = $post['no_hp_pegawai'];
        //add parameter here
        $this->db->update($this->_table,$this,[$this->_primary_key=>$post['nip']]);
    }

    public function delete($id){
        return $this->db->delete($this->_table,[$this->_primary_key=>$id]);
    }

}
/* End of file suffix_model.php */ ?>