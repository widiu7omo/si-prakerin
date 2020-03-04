<?php

namespace GeneticAlgorithm;
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'Gene.php';
require_once 'Chromosome.php';

class Main
{
	public $chromosomeLength = 0;
	public $components = array();
	public $population = 0;
	public $chromosomes = [];
	public $fitnessChromosomes = [];
	public $totalFitness = 0;
	public $crossOverRate = 0;

	private function generateChromosome()
	{
		$chromosome = new Chromosome();
		$gens = [];
		$generatedChromosome = [];
		if ($this->chromosomeLength > 0) {
			for ($i = 0; $i < $this->chromosomeLength; $i++) {
				$gen = new Gene();
				$gen->m = $this->components[0][rand(0, count($this->components[0]) - 1)];
				$gen->j = $this->components[1][rand(0, count($this->components[1]) - 1)];
				$gen->p = $this->components[2][rand(0, count($this->components[2]) - 1)];
				array_push($gens, $gen);
			}
			$generatedChromosome = $chromosome->makeWith($gens);
		}
		return $generatedChromosome;
	}

	public function getChromosomesByPopulation()
	{

		if ($this->population > 0) {
			for ($j = 0; $j < $this->population; $j++) {
				array_push($this->chromosomes, $this->generateChromosome());
			}
		}
	}

	function array_column_recursive(array $haystack, $needle)
	{
		$found = [];
		array_walk_recursive($haystack, function ($value, $key) use (&$found, $needle) {
			if ($key == $needle)
				$found[] = $value;
		});
		return $found;
	}

	function object_to_array($obj)
	{
		if (is_object($obj)) $obj = (array)$obj;
		if (is_array($obj)) {
			$new = array();
			foreach ($obj as $key => $val) {
				$new[$key] = $this->object_to_array($val);
			}
		} else $new = $obj;
		return $new;
	}

	public function getFitnessValue()
	{
		foreach ($this->chromosomes as $key => $chromosome) {
			$arrayChromosome = [];
			$fitnessEachChromosome = 0;
			foreach ($chromosome as $gens) {
				//ruangan tidak boleh sama pada waktu yang bersamaan
//					//penguji 1 tidak sama dengan penguji 2
				if ($gens->p->p1->name != $gens->p->p2->name) {
					$fitnessEachChromosome = $fitnessEachChromosome + 1;
				}
				//pembimbing tidak sama dengan penguji 1
				if ($gens->m->name != $gens->p->p1->name) {
					$fitnessEachChromosome = $fitnessEachChromosome + 1;
				}
				//pembimbing tidak sama dengan penguji 2
				if ($gens->m->name != $gens->p->p2->name) {
					$fitnessEachChromosome = $fitnessEachChromosome + 1;
				}
				//penguji tidak boleh berada pada ruangan berbeda pada waktu dan tanggal yang sama
				array_push($arrayChromosome, $this->object_to_array($gens));
			}

			$waktuTempat = $this->array_column_recursive($arrayChromosome, 'wt');
//			var_dump($countTgl);
			$countWaktuTempat = array_count_values($waktuTempat);
			foreach ($countWaktuTempat as $item) {
				//tanggal, tempat dan waktu hanya boleh sekali
				if ($item == 1) {
					$fitnessEachChromosome = $fitnessEachChromosome + 1;
					//@TODO:jika judul kasus sama, maka boleh
				}
			}

			array_push($this->fitnessChromosomes, (object)['fitness' => $fitnessEachChromosome]);
			$this->totalFitness = $this->totalFitness + $fitnessEachChromosome;
		}
//		echo json_encode($this->fitnessChromosomes);
	}

	private function getRandDecimal($max_dec)
	{
		$min = 0;
		$max = $max_dec;
		$decimals = 4;

		$divisor = pow(10, $decimals);
		return $randomFloat = mt_rand($min, $max * $divisor) / $divisor;
	}

	public function crossOver($max)
	{
		$chromosomes = $this->chromosomes;
		$crossOverRate = $this->crossOverRate;
		$chromosomeAsParent = [];
//		echo json_encode($chromosomes);
		$randNumbers = [];
		for ($i = 0; $i < count($chromosomes); $i++) {
			array_push($randNumbers, $this->getRandDecimal($max));
		}
		foreach ($chromosomes as $key => $chromosome) {
			if ($randNumbers[$key] < $crossOverRate) {
				array_push($chromosomeAsParent, $chromosome);
			}
		}
		echo json_encode($chromosomeAsParent);
		foreach ($chromosomeAsParent as $key => $candidate) {
			$lengthCandidate = count($candidate);
			$chromosomeAsParent[$key] = $chromosomeAsParent[rand(0, $lengthCandidate)];
		}
//		var_dump(count($chromosomeAsParent));

	}
}
