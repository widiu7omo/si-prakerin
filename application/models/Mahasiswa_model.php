<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    private $_table = 'tb_mahasiswa';
    private $_primary_key = 'nim';
    
    public $nim;
    public $username;
    public $nama_mahasiswa;
    public $alamat_mhs;
    public $jenis_kelamin_mhs;
    public $email_mhs;
    public $tempat_lahir_mhs;
    public $tanggal_lahir_mhs;
    public $no_hp_mahasiswa;
    public $nama_orangtua_mhs;
    public $no_hp_orangtua_mhs;
  
    //add parameter here

    public function rules(){
        return[
            [
                'field'=>'nim',
                'label'=>'Nim',
                'rules'=>'required'
            ],
            [
                'field'=>'nama_mahasiswa',
                'label'=>'NamaMahasiswa',
                'rules'=>'required'
            ]
        ];
    }

    public function getAll($idProdi = null){
    	$this->db->select('tm.*,prodi.nama_program_studi,tw.id_tahun_akademik')
		    ->from($this->_table.' tm')
		    ->join('tb_program_studi prodi','prodi.id_program_studi = tm.id_program_studi')
		    ->join('tb_waktu tw','tw.id_tahun_akademik = tm.id_tahun_akademik');
    	if($idProdi){
    		$this->db->where("prodi.id_program_studi = $idProdi");
	    }
        return $this->db->get()->result();
    }

    public function getById($id = null){
        return $this->db->get_where($this->_table,[$this->_primary_key=>$id])->row();
    }
//insert only for admin and akademik
    public function insert(){
	    $statusInsert = false;
    	$get_level = masterdata( 'tb_master_level','nama_master_level = "mahasiswa"');
    	$akun = new stdClass();
    	$level = new stdClass();
        $post = $this->input->post();
        $this->nim = $post['nim'];
        $this->id_tahun_akademik = $post['id_tahun_akademik'];
        $this->id_program_studi = $post['id_program_studi'];
        $this->username = $post['nim'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        $this->alamat_mhs = isset($post['alamat_mhs'])?$post['alamat_mhs']:null;
        $this->jenis_kelamin_mhs = isset($post['jenis_kelamin_mhs'])?$post['jenis_kelamin_mhs']:null;
        $this->email_mhs = isset($post['email_mhs'])?$post['email_mhs']:null;
        $this->tempat_lahir_mhs = isset($post['tempat_lahir_mhs'])?$post['tempat_lahir_mhs']:null;
        $this->tanggal_lahir_mhs = isset($post['tanggal_lahir_mhs'])?$post['tanggal_lahir_mhs']:null;
        $this->no_hp_mahasiswa = isset($post['no_hp_mahasiswa'])?$post['no_hp_mahasiswa']:null;
        $this->nama_orangtua_mhs = isset($post['nama_orangtua_mhs'])?$post['nama_orangtua_mhs']:null;
        $this->no_hp_orangtua_mhs = isset($post['no_hp_orangtua_mhs'])?$post['no_hp_orangtua_mhs']:null;
        //add parameter here
	    $akun->username = $post['nim'];
	    $akun->password = password_hash($post['nim'],PASSWORD_DEFAULT);

	    $level->username = $post['nim'];
	    $level->id_master_level = $get_level->id_master_level;
	    $this->db->trans_start();
	        $this->db->insert('tb_akun',$akun);
	        $this->db->insert('tb_level',$level);
	        $this->db->insert($this->_table,$this);
	    $this->db->trans_complete();
	    //if status transaction complete, return true
	    if ( $this->db->trans_status() != false ) {
		    $statusInsert = true;
	    }
	    return $statusInsert;
    }

    public function update(){
        $post = $this->input->post();
        $this->nim = $post['nim'];
        if(isset($post['id_tahun_akademik'])){
            $this->id_tahun_akademik = $post['id_tahun_akademik'];
            $this->id_program_studi = $post['id_program_studi'];
        }
        $this->username = $post['username'];
        $this->nama_mahasiswa = $post['nama_mahasiswa'];
        $this->alamat_mhs = isset($post['alamat_mhs'])?$post['alamat_mhs']:null;
        $this->jenis_kelamin_mhs = isset($post['jenis_kelamin_mhs'])?$post['jenis_kelamin_mhs']:null;
        $this->email_mhs = isset($post['email_mhs'])?$post['email_mhs']:null;
        $this->tempat_lahir_mhs = isset($post['tempat_lahir_mhs'])?$post['tempat_lahir_mhs']:null;
        $this->tanggal_lahir_mhs = isset($post['tanggal_lahir_mhs'])?$post['tanggal_lahir_mhs']:null;
        $this->no_hp_mahasiswa = isset($post['no_hp_mahasiswa'])?$post['no_hp_mahasiswa']:null;
        $this->nama_orangtua_mhs = isset($post['nama_orangtua_mhs'])?$post['nama_orangtua_mhs']:null;
        $this->no_hp_orangtua_mhs = isset($post['no_hp_orangtua_mhs'])?$post['no_hp_orangtua_mhs']:null;
        //add parameter here
        $this->db->update($this->_table,$this,[$this->_primary_key=>$post['nim']]);
    }

    public function delete($id){
        return $this->db->delete($this->_table,[$this->_primary_key=>$id]);
    }

}
/* End of file suffix_model.php */ ?>