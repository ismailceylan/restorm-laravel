<?php

namespace Iceylan\Restorm\Filter;

use ArrayAccess;
use Iceylan\Restorm\Support\BagContract;

class FilterBag implements ArrayAccess
{
	use BagContract;

	public function __construct()
	{
		$this->initialize( 'filter', Filter::class );
	}
}
