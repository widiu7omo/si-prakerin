<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kuesioner_model extends CI_Model
{

	private $_table = "tb_konsultasi_bimbingan";
	private $_primary_key = "id_konsultasi_bimbingan";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('master');
		//Do your magic here
	}

	public function get_bobot_awal()
	{
		$this->db->select('bobot_awal')->limit(1);
		return $this->db->get('tb_kuesioner_bobot_awal')->row();
	}

	public function get_bobot_fuzzy()
	{
		return $this->db->get('tb_kuesioner_bobot_fuzzy_ahp')->result();
	}

	public function insert_bobot_fuzzy()
	{
		$bobot_fuzzy = $_POST['fuzzy'];
		$values = [];
		foreach ($bobot_fuzzy as $item) {
			array_push($values, ['bobot_fuzzy_ahp' => $item['w_value'], 'id_kriteria' => $item['id']]);
		}
		$this->db->query('TRUNCATE tb_kuesioner_bobot_fuzzy_ahp');
		return $this->db->insert_batch('tb_kuesioner_bobot_fuzzy_ahp', $values);
	}

	public function insert_bobot_ahp()
	{
		$bobot = json_decode($_POST['bobot']);
		$bobot_ori = json_decode($_POST['bobot_ori']);
		$encode_bobot_ori = json_encode($bobot_ori);

		$values = [];
		foreach ($bobot as $item) {
			array_push($values, ['bobot_ahp' => $item->rata2, 'id_kriteria' => $item->id]);
		}
		$this->db->query('TRUNCATE tb_kuesioner_bobot_ahp');
		$this->db->query('TRUNCATE tb_kuesioner_bobot_awal');
		$this->db->query("INSERT INTO tb_kuesioner_bobot_awal(bobot_awal) VALUE('$encode_bobot_ori')");
		return $this->db->insert_batch('tb_kuesioner_bobot_ahp', $values);
	}

	public function insert_kriteria()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_kriteria', $post);
	}

	public function update_kriteria()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_kriteria');
	}

	public function delete_kriteria()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_kriteria');
	}

	public function get_kriteria($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_kriteria.id' => $id]);
		}
		$this->db->join('tb_master_level', 'tb_master_level.id_master_level = tb_kuesioner_kriteria.id_master_level', 'INNER');
		return $this->db->get('tb_kuesioner_kriteria')->result();
	}

	public function insert_pertanyaan()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_pertanyaan', $post);
	}

	public function update_pertanyaan()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_pertanyaan');
	}

	public function delete_pertanyaan()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_pertanyaan');
	}

	public function get_pertanyaan($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_pertanyaan.id' => $id]);
		}
		$this->db->select(['tb_kuesioner_pertanyaan.id', 'tb_kuesioner_pertanyaan.pertanyaan', 'tb_kuesioner_kriteria.kriteria', 'tb_kuesioner_kriteria.id id_kriteria']);
		$this->db->join('tb_kuesioner_kriteria', 'tb_kuesioner_kriteria.id = tb_kuesioner_pertanyaan.id_kriteria', 'INNER');
		return $this->db->get('tb_kuesioner_pertanyaan')->result();
	}

	public function insert_bobot()
	{
		$post = $this->input->post();
		return $this->db->insert('tb_kuesioner_bobot', $post);
	}

	public function update_bobot()
	{
		$post = $this->input->post();
		$this->db->where("id=$post[id]");
		$this->db->set($post);
		return $this->db->update('tb_kuesioner_bobot');
	}

	public function delete_bobot()
	{
		$get = $this->input->get();
		$this->db->where("id=$get[id]");
		return $this->db->delete('tb_kuesioner_bobot');
	}

	public function get_bobot($id = null)
	{
		if ($id) {
			$this->db->where(['tb_kuesioner_bobot.id' => $id]);
		}
		$this->db->join('tb_master_level', 'tb_master_level.id_master_level = tb_kuesioner_bobot.id_master_level', 'INNER');
		return $this->db->get('tb_kuesioner_bobot')->result();
	}

	public function get_jawaban_responder()
	{
		$this->db->query('SET @row_number = 0; ');
		$this->db->select(['(@row_number:=@row_number + 1) no', 'tkjr.*', 'tkp.id_kriteria', 'tkk.kriteria', 'tkp.pertanyaan', 'tp.nama_perusahaan', 'tkb.bobot'], false);
		$this->db->join('tb_kuesioner_pertanyaan tkp', 'tkp.id = tkjr.id_pertanyaan', 'INNER');
		$this->db->join('tb_perusahaan tp', 'tp.id_perusahaan = tkjr.id_perusahaan', 'INNER');
		$this->db->join('tb_kuesioner_bobot tkb', 'tkb.id = tkjr.id_bobot', 'INNER');
		$this->db->join('tb_kuesioner_kriteria tkk', 'tkk.id = tkp.id_kriteria', 'INNER');
		$this->db->order_by('tp.id_perusahaan,tkp.id_kriteria');
		return $this->db->get('tb_kuesioner_jawaban_responder tkjr')->result();
	}

	public function get_rekap_responder()
	{
		$jawaban_responder = $this->get_jawaban_responder();
		return $this->process_rekap($jawaban_responder);
	}


	public function process_rekap($jawaban_responder)
	{
		//strukturkan array jadi 3 dimensi
		$structured_responder = $this->structuring_array_responder($jawaban_responder);

//		echo '<pre>' . var_export($structured_responder, true) . '</pre>';
		//hitung total dan rata2 tiap perusahaan per kriteria
		return $this->count_weight($structured_responder);
	}

	private function count_weight($structured_responder)
	{
		//every perusahaan
		$rekap_perusahaan = [];
		$count_perusahaan = 0;
		foreach ($structured_responder as $i => $object_perusahaan) {
			//every kriteria
			$total_per_criteria = [];
			foreach ($object_perusahaan as $j => $items_criteria) {
				$total_weight_criteria = 0;
				$count = 0;
				foreach ($items_criteria as $item) {
					$total_weight_criteria += (float)$item->bobot;
					$count++;
				}
				$average = $total_weight_criteria / $count;
				$total_per_criteria['nama_perusahaan'] = $item->nama_perusahaan;
				$total_per_criteria['kriteria'][] = ['id_kriteria' => $item->id_kriteria, 'kriteria' => $item->kriteria, 'total_bobot' => $total_weight_criteria, 'average' => $average];
			}
			$count_perusahaan++;
			$total_per_criteria['no'] = $count_perusahaan;
			$rekap_perusahaan[] = $total_per_criteria;
		}
//		echo '<pre>' . var_export($rekap_perusahaan, true) . '</pre>';
		return $rekap_perusahaan;
	}

	private function structuring_array_responder($jawaban_responder)
	{
		$rekap = [];
		$id_kriteria_before = null;
		$id_perusahaan_before = null;
		foreach ($jawaban_responder as $jawaban) {
			$rekap['perusahaan_' . $jawaban->id_perusahaan]['kriteria_' . $jawaban->id_kriteria][] = $jawaban;
		}
//		echo '<pre>' . var_export($rekap, true) . '</pre>';
		return $rekap;
	}
}

/* End of file .php */
