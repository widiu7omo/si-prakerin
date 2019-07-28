<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuisioner2 extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "koordinator"){
			$this->session->sess_destroy();
			echo '<script language="javascript">alert("Akses Di Tolak!");';
			echo 'document.location="'.site_url('login').'";</script>';
		}		
		$this->load->model('koordinator/Mkuisioner2');

		$this->session->set_userdata('menu', 'kuisioner2');

		$this->load->library('dompdf_gen');
	}

	//fungsi halaman awal kuisioner2
public function index()
	{
		$data['level'] = $this->session->userdata('status');

		$data['data_monitoring'] = $this->Mkuisioner2->get_monitoring2();

		$this->load->view('koordinator/tema/head',$data);
		$this->load->view('koordinator/tema/menu');
		$this->load->view('koordinator/kuisioner2/kuisioner2');
		$this->load->view('koordinator/tema/footer');
	}

public function isi_kuisioner2()
	{
		$data['level'] = $this->session->userdata('status');

		$id_perusahaan = $this->input->get('id_perusahaan');
		$data['data_perusahaan'] = $this->db->query("SELECT * FROM tb_perusahaan WHERE id_perusahaan='$id_perusahaan'");
		$cek = $this->Mkuisioner2->cek($id_perusahaan);
		if($cek->result())
		{
			$data['data_soal_kuesioner'] = $this->Mkuisioner2->cek($id_perusahaan);
			echo '<script language="javascript">alert("Data Kuisioner Sudah Diisi!");</script>';
			$this->load->view('koordinator/tema/head',$data);
			$this->load->view('koordinator/tema/menu');
			$this->load->view('koordinator/kuisioner2/isi_kuisioner');
			$this->load->view('koordinator/tema/footer');
		}
		else
		{
			$data['data_soal_kuesioner'] = $this->Mkuisioner2->get_kuisioner();
			$this->load->view('koordinator/tema/head',$data);
			$this->load->view('koordinator/tema/menu');
			$this->load->view('koordinator/kuisioner2/isi_kuisioner2');
			$this->load->view('koordinator/tema/footer');
		}
	}
public function cetak_kuisioner()
    {
        $id_perusahaan  = $this->input->get('id_perusahaan');

        $data['id_perusahaan']= $id_perusahaan;
        $data['cetak_kuisioner'] = $this->db->query("SELECT tb_soal_kuisioner.id_soal_kuisioner, tb_soal_kuisioner.soal_kuisioner, tb_jawaban_kuisioner.id_jawaban_kuisioner,tb_jawaban_kuisioner.jawaban, tb_jawaban_kuisioner.id_perusahaan FROM `tb_soal_kuisioner` JOIN tb_jenis_kuisioner ON tb_soal_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner JOIN tb_jawaban_kuisioner ON tb_jawaban_kuisioner.id_soal_kuisioner=tb_soal_kuisioner.id_soal_kuisioner WHERE tb_jawaban_kuisioner.id_perusahaan='10' ORDER BY tb_soal_kuisioner.id_soal_kuisioner ASC");

        $html = $this->load->view('koordinator/Kuisioner2/cetak_kuisioner',$data,true);

        $dompdf = new dompdf();
        $dompdf->set_paper('L','portrait');
        //$dompdf->setPaper ('A4','potrait');
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Data_test.pdf', array("Attachment"=>0));
    }

   	public function insert_isi_kuisioner()
	{
		$this->Mkuisioner2->bacth_insert();
		
		echo '<script language="javascript">alert("Data Berhasil Disimpan!");';
		echo 'document.location="'.site_url('koordinator/Kuisioner2').'";</script>';
	}

	public function update_isi_kuisioner()
	{
		$this->Mkuisioner2->bacth_update();
		
		echo '<script language="javascript">alert("Data Berhasil Diperbaharui!");';
		echo 'document.location="'.site_url('koordinator/Kuisioner2').'";</script>';
	}
}
