<?php

namespace Iceylan\Restorm\Sort;

use Iceylan\Restorm\Target;

class Sort
{
	public Target $target;
	
	public function __construct( string $target, public string $direction )
	{
		$this->target = new Target( $target );
	}
}
