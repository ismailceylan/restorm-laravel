<?php

namespace Iceylan\Restorm\Field;

use ArrayAccess;
use Iceylan\Restorm\Support\BagContract;

class FieldBag implements ArrayAccess
{
	use BagContract;

	public function __construct()
	{
		$this->initialize( 'field', Field::class );
	}
}
