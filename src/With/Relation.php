<?php

namespace Iceylan\Restorm\With;

use Iceylan\Restorm\Restorm;
use Iceylan\Restorm\Target;

class Relation
{
	public Target $target;

	public function __construct( Restorm $restorm, string $name )
	{
		$this->target = new Target( $name, 'relation' );
	}
}
