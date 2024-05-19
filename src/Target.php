<?php

namespace Iceylan\Restorm;

class Target
{
	public array $models;
	public string|null $field;

	public function __construct( string $target )
	{
		$parts = explode( '.', $target );

		if( count( $parts ) === 1 && ! is_numeric( $parts[ 0 ]))
		{
			$this->models[] = $parts[ 0 ];
			$this->field = null;
		}
		else
		{
			$this->field = array_pop( $parts );
			$this->models = $parts;
		}
	}

	public function isRelation(): bool
	{
		return count( $this->models ) > 0;
	}
}
