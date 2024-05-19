<?php

namespace Iceylan\Restorm\Field;

use Iceylan\Restorm\Target;
use Iceylan\Restorm\Value;

class Field
{
	public Target $target;
	public Value $value;

	public function __construct( string $key, string $value )
	{
		$this->target = new Target( $key, type: 'relation' );
		$this->value = new Value( $value );
	}

	public function forRelation(): bool
	{
		return $this->target->isRelation();
	}

	public function apply( $model )
	{
		$model->select( $this->value->value );
	}
}
