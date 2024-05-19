<?php

namespace Iceylan\Restorm\Filter;

class Operator
{
	public string $name;

	public function __construct( public string $rawOperator )
	{
		$map =
		[
			'eq' => 'equal',
			'ne' => 'notequal',
			'lt' => 'less',
			'gt' => 'greater',
			'lte' => 'lesseq',
			'gte' => 'greatereq',
			'bw' => 'between',
			'in' => 'in',
			'nbw' => 'notbetween',
			'lk' => 'like',
			'nlk' => 'notlike',
			'nl' => 'null',
			'nnl' => 'notnull',
		];

		$this->name = $map[ $this->rawOperator ] ?? $this->rawOperator;
	}
}
