<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['perusahaan_model','pengajuan_model']);
		$this->load->helper(['notification','master']);
		!$this->session->userdata('level')?redirect(site_url('main')):null;
		$id = $this->session->userdata('id');
		$mahasiswa = masterdata( 'tb_mahasiswa',['nim'=>$id],['alamat_mhs','email_mhs','jenis_kelamin_mhs'],false);
		($mahasiswa->alamat_mhs == null || $mahasiswa->email_mhs == null || $mahasiswa->jenis_kelamin_mhs == null)?redirect(site_url('user/profile')):null;
		//Do your magic here
	}
    public function index()
    {
        $level = $this->session->userdata('level');
        switch($level){
            case 'mahasiswa':
            $data['menus'] = array(
                array('name'=>'Jadwal Sidang',
                    'href'=>site_url('sidang?m=jadwal'),
                    'icon'=>'fas fa-id-badge',
                    'desc'=>'Informasi terkait jadwal sidang peserta prakerin'),
                array('name'=>'Penilaian',
                    'href'=>site_url('sidang?m=penilaian'),
                    'icon'=>'fas fa-building',
                    'desc'=>'Penilaian peserta sidang prakerin'),
            );
            break;
            case 'dosen':
            $data['menus'] = array(
                array('name'=>'Monev Prakerin',
                    'href'=>'https://monev.prakerin.politala.ac.id',
                    'desc'=>'Aplikasi monitoring tempat Praktik kerja lapangan'),
                array('name'=>'Kuesioner Dosen',
                    'href'=>site_url('kuesioner?m=dsn'),
                    'desc'=>'Kuesioner bagi dosen tentang bla bla bla')
            );
            break;
            default:$data['menus']= [];
        }
        $this->load->view('user/magang',$data);
        
    }

}

/* End of file Magang.php */
 ?>