<?php

namespace Iceylan\Restorm;

class Target
{
	public array $models = [];
	public string|null $field = null;

	public function __construct( string $target, string $type )
	{
		if( $type == 'relation' )
		{
			if( is_numeric( $target ))
			{
				// there is nothing to do
			}
			else
			{
				$this->models = explode( '.', $target );
			}
		}
		else if( $type == 'field' )
		{
			if( strpos( $target, '.' ) === false )
			{
				$this->field = $target;
			}
			else
			{
				$parts = explode( '.', $target );

				$this->field = array_pop( $parts );
				$this->models = $parts;
			}
		}
	}

	public function isRelation(): bool
	{
		return count( $this->models ) > 0;
	}

	public function __toString(): string
	{
		$stack = [ ...$this->models ];

		if( $this->field )
		{
			$stack[] = $this->field;
		}

		return implode( '.', $stack );
	}

	public function getFullModelNS(): string
	{
		return implode( '.', $this->models );
	}
}
