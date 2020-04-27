<?php defined('BASEPATH') OR exit('No direct script access allowed');

use GeneticAlgorithm\Main;

require APPPATH . 'libraries/GeneticAlgorithm/Main.php';

class GAGenerator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('seminar_model', 'pembimbing_model'));
	}

	public function index()
	{
		$seminar = $this->seminar_model;
		$pembimbing = $this->pembimbing_model;
		$this->db->truncate('tb_ga_component');

		//gen 1
		$subGen1 = [];
		$mhs = $pembimbing->get_all_approved_judul();
		foreach ($mhs as $sub) {
			array_push($subGen1, (object)['id' => $sub->id_dosen_bimbingan_mhs, 'name' => $sub->nama_pegawai]);
		}
		//gen 2
		$subGen2 = [];
		$tanggal = $seminar->get_tanggal_seminar();
		$waktu = $seminar->get_waktu_seminar();
		$tempat = $seminar->get_tempat_seminar();
		foreach ($tanggal as $tg) {
			foreach ($waktu as $wk) {
				foreach ($tempat as $tm) {
					$sub = (object)['wt' => $tg->id . '-' . $wk->id . '-' . $tm->id];
					array_push($subGen2, $sub);
				}
			}
		}
//		echo json_encode($subGen2);
		//gen 3
		$subGen3 = [];
		$penguji_1 = $seminar->get_all_penguji('p1');
		$penguji_2 = $seminar->get_all_penguji('p2');
		foreach ($penguji_1 as $p1) {
			foreach ($penguji_2 as $p2) {
//				if ($p1->nama_pegawai != $p2->nama_pegawai) {
				$sub = (object)['p1' => (object)['id' => $p1->id, 'name' => $p1->nama_pegawai], 'p2' => (object)['id' => $p2->id, 'name' => $p2->nama_pegawai]];
				array_push($subGen3, $sub);
//				}
			}
		}

		$ga = new Main();
		$ga->chromosomeLength = count($subGen1);
		$ga->components = [$subGen1, $subGen2, $subGen3];
		$ga->population = 100;
		$ga->getChromosomesByPopulation();
//		echo json_encode($ga->chromosomes);
		$ga->getFitnessValue();
//		var_dump($ga->totalFitness);
		$probabilitas = $this->probilitasIndividu($ga->fitnessChromosomes, $ga->totalFitness);
		$max = $probabilitas[count($probabilitas) - 1]->max_prob;
		$selection = $this->rouletteWheel($probabilitas, $max, $ga->chromosomes);
		$ga->components = $selection;
		$ga->crossOverRate = 0.5;
		$ga->crossOver($max);
//		echo json_encode(['new'=>$selection,'old'=>$ga->chromosomes]);
	}

	public function rouletteWheel($probs, $max_prob, $chromosomes)
	{
		$parentSelected = array();
//		$probChromosomePast = 0;
		foreach ($probs as $key => $individual) {
			$randomNumber = $this->getRandDecimal($max_prob);
			if ($key == 0) {
				if ($randomNumber < $individual->min_prob) {
					array_push($parentSelected, $chromosomes[0]);
				} else {
					array_push($parentSelected, $chromosomes[$key + 1]);
				}
			} else {
				if ($randomNumber > $individual->min_prob && $randomNumber < $probs[$key + 1]->max_prob) {
					array_push($parentSelected, $chromosomes[$key]);
				} else {
					array_push($parentSelected, $chromosomes[$key - 1]);
				}
			}
//			$probChromosomePast = $individual->prob_individu;
		}
		return $parentSelected;
	}

	public function getParents()
	{

	}

	public function getRandDecimal($max_dec)
	{
		$min = 0;
		$max = $max_dec;
		$decimals = 4;

		$divisor = pow(10, $decimals);
		return $randomFloat = mt_rand($min, $max * $divisor) / $divisor;
	}

	public function probilitasIndividu($fitnessIndividuals, $totalFitness)
	{
		$min = 0;
		$max = 0;
		$final = [];
		foreach ($fitnessIndividuals as $key => $fi) {
			$prob_individu = $fi->fitness / $totalFitness;
			$percentage_prob = $prob_individu * 100;
			$max = $min + ($prob_individu / 100 * 100);
			$final[$key] = (object)["prob_individu" => round($prob_individu, 4), "percentage_prob" => round($percentage_prob, 4), "min_prob" => round($min, 4), "max_prob" => round($max, 4)];
			$min = $min + ($prob_individu / 100 * 100) + 0.001;
		};
		return $final;
	}

}
