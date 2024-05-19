<?php

namespace Iceylan\Restorm\Filter;

class ValueBag
{
	public array|string $value;

	public function __construct( string $value )
	{
		$this->value = strpos( $value, ',' ) > 0
			? explode( ',', $value )
			: $value;
	}

	public function isMultiple()
	{
		return is_array( $this->value ) && count( $this->value ) > 1;
	}
}
