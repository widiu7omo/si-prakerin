<?php

namespace GeneticAlgorithm;
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main
{

	private $chromosome = array();
	private $components = array();

	public function __construct($components)
	{
		$this->components = $components;
	}

	public function isExist($arr, $key, $string, $index)
	{
		foreach ($arr as $i => $array) {
			if ($index != $i) {
				return $array['gen_2']->{$key} == $string;
			}
		}
		return false;
	}

	public function generateChromosomes()
	{
		$generatedChromosomes = array();
		$secondGenes = $this->components[1];
		if (count($this->components) === 2) {
			foreach ($this->components[0] as $component) {
				array_push($generatedChromosomes, array('gen_1' => $component, 'gen_2' => $secondGenes[rand(0, count($secondGenes) - 1)]));
			}
		}
		return $generatedChromosomes;
	}

	public function checkFitnessValue($chromosomes)
	{
		foreach ($chromosomes as $key => $chromosome) {
			//cek fitness dengan kondisi
			//jika kondisi tidak
			$fitness_value = 0;
			//jika nama pe
			if ($chromosome['gen_1']->nama_pegawai !== $chromosome['gen_2']->penguji1) {
				$fitness_value = $fitness_value + 1;
			}
			if ($chromosome['gen_1']->nama_pegawai !== $chromosome['gen_2']->penguji2) {
				$fitness_value = $fitness_value + 1;
			}
			//ada yang sama tanggal?
			$isTanggalExist = $this->isExist($chromosomes, 'tanggal', $chromosome['gen_2']->tanggal, $key);
			$isWaktuExist = $this->isExist($chromosomes, 'waktu', $chromosome['gen_2']->waktu, $key);
			$isRuanganExist = $this->isExist($chromosomes, 'ruangan', $chromosome['gen_2']->ruangan, $key);
			if (!$isTanggalExist) {
				$fitness_value = $fitness_value + 1;
			}
			if (!$isWaktuExist) {
				$fitness_value = $fitness_value + 1;
			}
			if (!$isRuanganExist) {
				$fitness_value = $fitness_value + 1;
			}
			if(!$isRuanganExist and !$isTanggalExist and !$isWaktuExist){
				$fitness_value = $fitness_value + 1;
			}

			$chromosome['fitness_value'] = $fitness_value;
			$pop_with_finess[] = $chromosome;
		}
		return $pop_with_finess;
	}

	public function crossOver()
	{
		//cek nilai fitnes dari masing2 kromosom

		//ambil parent yang nilai fitesnya lebih tinggi
		//kawin silangkan parent yang terbaik
		//replace parent yang nilai fitnesnya jelek dengan child hasil kawin silang
		//sehingga total kromosom masih tetap sama dengan jumlah kromosom awal
	}

}
