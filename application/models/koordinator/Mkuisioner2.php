<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mkuisioner2 extends CI_Model {

public function bacth_insert()
	{
		$nip_nik = $this->input->post('nip_nik');
		$id_perusahaan = $this->input->post('id_perusahaan');
		$id_data_kuisioner = $this->input->post('id_data_kuisioner');
		$jawaban = $this->input->post('jawaban');

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

		$config['upload_path']          = './assets/foto/';
		$config['allowed_types']        = '*';
		//$config['file_name']            = $foto;
		$config['overwrite']			= true;

		$files = $_FILES;
		$count2 = count($_FILES['foto']['name']);

		for($x = 0; $x < $count2; $x++) {
		   	$_FILES['foto']['name'] = $files['foto']['name'][$x];
		   	$_FILES['foto']['type'] = $files['foto']['type'][$x];
		   	$_FILES['foto']['tmp_name'] = $files['foto']['tmp_name'][$x];
		   	$_FILES['foto']['error'] = $files['foto']['error'][$x];
		   	$_FILES['foto']['size'] = $files['foto']['size'][$x];

		   	$foto = $_FILES['foto']['name']; 
		   	$jenis = $_FILES['foto']['type'];

		   	$this->load->library('upload', $config);
			$this->upload->do_upload('foto');

			$upload_data = $this->upload->data();

		   	$this->db->query("INSERT INTO `tb_berkas_perusahaan` (`id_berkas_perusahaan`, `id_perusahaan`, `extensi_berkas_perusahaan`, `nama_berkas_perusahaan`, `tanggal_upload_perusahaan`) VALUES (NULL, '$id_perusahaan', '$jenis', '$foto' , CURRENT_TIMESTAMP);");
		}
	}

public function bacth_update()
	{

		$id_jawaban_kuisioner = $this->input->post('id_jawaban_kuisioner');
		$jawaban = $this->input->post('jawaban');
		$nip_nik = $this->input->post('nip_nik');
		$id_perusahaan = $this->input->post('id_perusahaan');

		$count = count($id_jawaban_kuisioner);

		for($i = 0; $i<$count; $i++) {
			$entries[] = array(
				'id_jawaban_kuisioner'=>$id_jawaban_kuisioner[$i],
				'jawaban'=>$jawaban[$i],
				'nip_nik'=>$nip_nik,
			);
		};
		$this->db->update_batch('tb_jawaban_kuisioner', $entries,'id_jawaban_kuisioner');

		$this->db->query("DELETE FROM `tb_berkas_perusahaan` WHERE tb_berkas_perusahaan.id_perusahaan = '$id_perusahaan'");

		$config['upload_path']          = './assets/foto/';
		$config['allowed_types']        = '*';
		//$config['file_name']            = $foto;
		$config['overwrite']			= true;

		$files = $_FILES;
		$count2 = count($_FILES['foto']['name']);

		for($x = 0; $x < $count2; $x++) {
		   	$_FILES['foto']['name'] = $files['foto']['name'][$x];
		   	$_FILES['foto']['type'] = $files['foto']['type'][$x];
		   	$_FILES['foto']['tmp_name'] = $files['foto']['tmp_name'][$x];
		   	$_FILES['foto']['error'] = $files['foto']['error'][$x];
		   	$_FILES['foto']['size'] = $files['foto']['size'][$x];

		   	$foto = $_FILES['foto']['name']; 
		   	$jenis = $_FILES['foto']['type'];

		   	$this->load->library('upload', $config);
			$this->upload->do_upload('foto');

			$upload_data = $this->upload->data();

		   	$this->db->query("INSERT INTO `tb_berkas_perusahaan` (`id_berkas_perusahaan`, `id_perusahaan`, `extensi_berkas_perusahaan`, `nama_berkas_perusahaan`, `tanggal_upload_perusahaan`) VALUES (NULL, '$id_perusahaan', '$jenis', '$foto' , CURRENT_TIMESTAMP);");
		}
	}

public function get_monitoring2()
	{
		$query = $this->db->query("SELECT tb_monev.id_monev, tb_monev.no_surat, tb_monev.nip_nik, tb_perusahaan.id_perusahaan, tb_perusahaan.nama_perusahaan, tb_monev.tgl_berangkat, tb_monev.tgl_pulang, tb_monev.status FROM tb_monev JOIN tb_perusahaan ON tb_monev.id_perusahaan = tb_perusahaan.id_perusahaan");
		return $query;
	}

public function cek($id_perusahaan)
	{
		$query = $this->db->query("SELECT tb_jawaban_kuisioner.nip_nik, tb_jawaban_kuisioner.id_perusahaan, tb_data_kuisioner.id_data_kuisioner, tb_data_kuisioner.soal_kuisioner, tb_jawaban_kuisioner.id_jawaban_kuisioner,tb_jawaban_kuisioner.jawaban, tb_jawaban_kuisioner.id_perusahaan FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner JOIN tb_jawaban_kuisioner ON tb_jawaban_kuisioner.id_data_kuisioner=tb_data_kuisioner.id_data_kuisioner WHERE tb_jawaban_kuisioner.id_perusahaan='$id_perusahaan' AND tb_jenis_kuisioner.id_jenis_kuisioner='11' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

public function get_kuisioner()
	{
		$query = $this->db->query("SELECT * FROM `tb_data_kuisioner` JOIN tb_jenis_kuisioner ON tb_data_kuisioner.id_jenis_kuisioner = tb_jenis_kuisioner.id_jenis_kuisioner WHERE tb_data_kuisioner.id_jenis_kuisioner='11' ORDER BY tb_data_kuisioner.id_data_kuisioner ASC");
		return $query;
	}

}