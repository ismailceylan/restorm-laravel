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
			'nin' => 'notin',
			'nbw' => 'notbetween',
			'lk' => 'like',
			'nlk' => 'notlike',
			'nl' => 'null',
			'nn' => 'notnull',
		];

		if( ! array_key_exists( $rawOperator, $map ))
		{
			throw new \Exception( "Unknown operator: $rawOperator" );
		}

		$this->name = $map[ $rawOperator ];
	}
}
