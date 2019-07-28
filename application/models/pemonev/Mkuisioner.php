<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkuisioner extends CI_Model {

public function cek($id_perusahaan)
	{
		$query = $this->db->query("SELECT tb_data_kuisioner.id_data_kuisioner, tb_data_kuisioner.soal_kuisioner, tb_jawaban_kuisioner.id_jawaban_kuisioner,tb_jawaban_kuisioner.jawaban, tb_jawaban_kuisioner.id_perusahaan FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner JOIN tb_jawaban_kuisioner ON tb_jawaban_kuisioner.id_data_kuisioner=tb_data_kuisioner.id_data_kuisioner WHERE tb_jawaban_kuisioner.id_perusahaan='$id_perusahaan' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

public function get_kuisioner()
	{
		$query = $this->db->query("SELECT * FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner WHERE tb_jenis_kuisioner.jenis_kuisioner = 'pemonitoring' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}
public function bacth_insert()
	{

		$nip_nik = $this->input->post('nip_nik');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$id_data_kuisioner = $this->input->post('id_data_kuisioner');
		$jawaban = $this->input->post('jawaban');
		$foto = $this->input->post('foto');

		$status = 'Selesai';

		$count = count($id_data_kuisioner);

		for($i = 0; $i<$count; $i++) {
			$entries[] = array(
				'nip_nik'=>$nip_nik,
				'id_perusahaan'=>$id_perusahaan,
				'id_data_kuisioner'=>$id_data_kuisioner[$i],
				'jawaban'=>$jawaban[$i],
			);
		};
		$query = $this->db->insert_batch('tb_jawaban_kuisioner', $entries);
		$query2 = $this->db->query("UPDATE `tb_monev` SET `status` = '$status' WHERE `tb_monev`.`id_perusahaan` = '$id_perusahaan'");

		//Proses Upload File

		$this->db->query("DELETE FROM `tb_berkas_perusahaan` WHERE tb_berkas_perusahaan.id_perusahaan = '$id_perusahaan'");

		$foto = $_FILES['foto']['name'];
		$config['upload_path']          = './assets/foto/';
		$config['allowed_types']        = '*';
		$config['file_name']            = $this->input->post('foto');
	    //$config['overwrite']			= true;
	   	//$config['max_size']             = 2048; // 1MB
		$this->load->library('upload', $config);
		$this->upload->do_upload('foto');
		$this->upload->data('file_name');

		$this->db->query("INSERT INTO `tb_berkas_perusahaan` (`id_berkas_perusahaan`, `id_perusahaan`, `nama_berkas_perusahaan`, `tanggal_upload_perusahaan`) VALUES (NULL, '$id_perusahaan', '$foto' , CURRENT_TIMESTAMP);");
	}

public function bacth_update()
	{

		$id_jawaban_kuisioner = $this->input->post('id_jawaban_kuisioner');
		$jawaban = $this->input->post('jawaban');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$foto = $this->input->post('foto');

		$count = count($id_jawaban_kuisioner);

		for($i = 0; $i<$count; $i++) {
			$entries[] = array(
				'id_jawaban_kuisioner'=>$id_jawaban_kuisioner[$i],
				'jawaban'=>$jawaban[$i],
			);
		};
		$this->db->update_batch('tb_jawaban_kuisioner', $entries,'id_jawaban_kuisioner');

		$this->db->query("DELETE FROM `tb_berkas_perusahaan` WHERE tb_berkas_perusahaan.id_perusahaan = '$id_perusahaan'");

			$foto = $_FILES['foto']['name'];
			$config['upload_path']          = './assets/foto/';
			$config['allowed_types']        = '*';
			$config['file_name']            = $this->input->post('foto');
	    	//$config['overwrite']			= true;
	   		//$config['max_size']             = 2048; // 1MB

		    $this->load->library('upload', $config);
		    $this->upload->do_upload('foto');
		    $this->upload->data('file_name');


		    $this->db->query("INSERT INTO `tb_berkas_perusahaan` (`id_berkas_perusahaan`, `id_perusahaan`, `nama_berkas_perusahaan`, `tanggal_upload_perusahaan`) VALUES (NULL, '$id_perusahaan', '$foto' , CURRENT_TIMESTAMP);");
	}

}