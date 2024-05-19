<?php

namespace Iceylan\Restorm\Filter;

class Target
{
	public array $models;
	public string $field;

	public function __construct( string $target )
	{
		$parts = explode( '.', $target );

		$this->field = array_pop( $parts );
		$this->models = $parts;
	}

	public function isRelation(): bool
	{
		return count( $this->models ) > 0;
	}
}
