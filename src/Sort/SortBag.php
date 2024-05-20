<?php

namespace Iceylan\Restorm\Sort;

use ArrayAccess;
use Iceylan\Restorm\Support\BagContract;

class SortBag implements ArrayAccess
{
	use BagContract;

	public function __construct()
	{
		$this->initialize( 'sort', Sort::class );
	}
}
