<?php

namespace Iceylan\Restorm;

class Target
{
	public array $models = [];
	public string|null $field;

	public function __construct( string $target )
	{
		$parts = explode( '.', $target );

		if( count( $parts ) === 1 )
		{
			$this->field = $parts[ 0 ];
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
