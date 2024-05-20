<?php

namespace Iceylan\Restorm\Filter;

use Iceylan\Restorm\Value;

class Conditions
{
	public Operator $operator;
	public Value $value;

	public function __construct( string $conditions )
	{
		$parts = explode( ':', $conditions );

		if( count( $parts ) !== 2 )
		{
			throw new \Exception(
				"[Restorm] Invalid filter conditions: $conditions. Format should be <operator>:$conditions"
			);
		}

		$this->operator = new Operator( $parts[ 0 ]);
		$this->value = new Value( $parts[ 1 ] ?? true );
	}
}
