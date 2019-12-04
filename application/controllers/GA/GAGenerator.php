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
		$komponent_kromosom_1 = $pembimbing->get_all_approved_judul();
		$this->db->truncate('tb_ga_component');
		$tempat = $seminar->get_tempat_seminar();
		$waktu = $seminar->get_waktu_seminar();
		$tanggal = $seminar->get_tanggal_seminar();
		$penguji_1 = $seminar->get_all_penguji('p1');
		$penguji_2 = $seminar->get_all_penguji('p2');
//		echo "Banyak kemungkinan kombinasi komponen 2 tidak sama adalah :" . (count($tempat) *count($tanggal) * count($waktu) * count($penguji_1) * count($penguji_2))/2;
		foreach ($tempat as $r) {
			foreach ($tanggal as $t) {
				foreach ($waktu as $w) {
					foreach ($penguji_1 as $p1) {
						foreach ($penguji_2 as $p2) {
							$kemungkinanx['ruangan'] = $r->nama;
							$kemungkinanx['tanggal'] = $t->hari.', '.$t->tanggal;
							$kemungkinanx['waktu'] = $w->jam;
							$kemungkinanx['penguji1'] = $p1->nama_pegawai;
							$kemungkinanx['penguji2'] = $p2->nama_pegawai;
							if ($p1 != $p2) {
								$kemungkinans[] = (object)$kemungkinanx;
							}
						}
					}
				}
			}
		}
		$this->db->insert_batch('tb_ga_component', $kemungkinans);
//		echo json_encode($kemungkinans, JSON_PRETTY_PRINT);
		//gen 1
		$components[] = $komponent_kromosom_1;
		//gen 2
		$components[] = $kemungkinans;
		//total individu in population
		$population = 50;
		$individuals = array();
		$fitnessIndividuals = array();
		$totalFitness = 0;
		for($i = 0;$i<$population;$i++){
			$GaMain = new Main($components);
			$populations = $GaMain->generateChromosomes();
			$populationWithFitnessValue = $GaMain->checkFitnessValue($populations);
			$fitnessChromosome = 0;
			foreach ($populationWithFitnessValue as $fitnesBySlot){
				$fitnessChromosome = $fitnessChromosome+$fitnesBySlot['fitness_value'];
			}
			//input
			//roulette wheel
			//nilai fitness masing2 individu
			$fitnessIndividu = $fitnessChromosome/(count($populationWithFitnessValue)*6);
			$fitnessIndividuals[$i] = round($fitnessIndividu,3);
			//total fitnes
			$totalFitness = $totalFitness+$fitnessIndividu;
			$individuals[$i] = array('chromosomes'=>$populationWithFitnessValue,'fitness_individu'=>round($fitnessIndividu,3));
		}
		//probabilitas fitnes masing2 individu
		$probIndividu = $this->probilitasIndividu($individuals,$totalFitness);
		echo json_encode($probIndividu);
		$selectedIndividual = $this->rouletteWheel($probIndividu);
//		echo json_encode($selectedIndividual);
		$res = 0;
		foreach ($individuals as $individual){
			$res = $res+$individual['fitness_individu'];
		}
//		var_dump($res);
//		echo json_encode($individuals);
//		echo json_encode($pembimbing->get_all_approved_judul(),JSON_PRETTY_PRINT);
	}
	public function rouletteWheel($individuals){
		$count = 5;
		$parentSelected = array();
		for($i = 0;$i<$count;$i++){
			$randomNumber = $this->getRandDecimal();
			foreach ($individuals as $individual){
				if($randomNumber >= $individual->min and $randomNumber <= $individual->max){
					array_push($parentSelected,$individual);
				}
			}
		}
		return $parentSelected;
	}
	public function getParents(){

	}
	public function getRandDecimal(){
		$min = 0;
		$max = 100;
		$decimals = 3;

		$divisor = pow(10, $decimals);
		return $randomFloat = mt_rand($min, $max * $divisor) / $divisor;
	}
	public function probilitasIndividu($fitnessIndividuals,$totalFitness){
		$min = 0;
		$max = 0;
		foreach($fitnessIndividuals as $key=> $fi){
			$prob_individu = $fi['fitness_individu']/$totalFitness;
			$percentage_prob = $prob_individu*100;
			$max = $min + ($percentage_prob/100*100);
			$final[$key] =(object) array("chromosomes"=>$fi['chromosomes'],"prob_individu"=>round($prob_individu,3),"percentage_prob"=>round($percentage_prob,3),"min"=>round($min,3),"max"=>round($max,3));
			$min = $min + ($percentage_prob/100*100)+0.001;
		};
		return $final;
	}

}
