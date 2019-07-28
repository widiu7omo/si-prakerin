<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunakademik_model extends CI_Model {

    private $_table = 'tahun_akademik';

    private $_primary_key = 'id_tahun_akademik';
    public $id_tahun_akademik;
    public $tahun_akademik;
  
    //add parameter here

    public function rules(){
        return[
            [
                'field'=>'name',
                'label'=>'Tahun Akademik',
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
        $this->id_tahun_akademik = $post['id'];
        $this->tahun_akademik = $post['name'];
        //add parameter here
        $this->db->insert($this->_table,$this);
    }

    public function update(){
        $post = $this->input->post();

        $this->id_tahun_akademik = $post['id'];
        $this->tahun_akademik = $post['name'];
        //add parameter here
        $this->db->update($this->_table,$this,[$this->_primary_key=>$post['id']]);
    }

    public function delete($id){
        return $this->db->delete($this->_table,[$this->_primary_key=>$id]);
    }
    //fungsi tambahan
    public function update_waktu(){
        $post = $this->input->post();
        $id = isset($post['id'])?$post['id']:'0';
        $id_ta = $post['id_tahun_akademik'];
        $currentTahun = getCurrentTahun();
        if(isset($currentTahun->now)){
            //if isset, then you can update
            return $this->db->update('tb_waktu',['id_tahun_akademik'=>$id_ta],['id_waktu'=>$id]);
        }
        else{
            //insert first
            return $this->db->insert('tb_waktu',['id_tahun_akademik'=>$id_ta,'id_waktu'=>$id]);
        }
    }

}
/* End of file suffix_model.php */ ?>