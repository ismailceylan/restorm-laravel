<?php

namespace Iceylan\Restorm\Sort;

use Iceylan\Restorm\Target;

class Sort
{
	public Target $target;
	
	public function __construct( string $target, public string $direction )
	{
		$this->target = new Target( $target, type: 'field' );
	}

	public function forRelation(): bool
	{
		return $this->target->isRelation();
	}

	public function apply( $model )
	{
		$model->orderBy(
			$this->target->field,
			$this->direction
		);
	}
}
