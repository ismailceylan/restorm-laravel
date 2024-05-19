<?php

namespace Iceylan\Restorm\Filter;

class Conditions
{
	public Operator $operator;
	public ValueBag $value;

	public function __construct( string $conditions )
	{
		$parts = explode( ':', $conditions );

		if( count( $parts ) !== 2 )
		{
			throw new \Exception(
				"Invalid filter conditions: $conditions. Format should be <operator>:$conditions"
			);
		}

		$this->operator = new Operator( $parts[ 0 ]);
		$this->value = new ValueBag( $parts[ 1 ]);
	}
}
