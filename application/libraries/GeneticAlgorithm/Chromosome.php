<?php
namespace GeneticAlgorithm;

class Chromosome
{
	public $chromosome = [];

	public function makeWith($gens)
	{
		foreach ($gens as $gen) {
			array_push($this->chromosome, $gen);
		}
		return $this->chromosome;
	}
}
