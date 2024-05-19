<?php

namespace Iceylan\Restorm\Field;

use ArrayAccess;
use Iceylan\Restorm\Support\ArrayAccessible;

class FieldBag implements ArrayAccess
{
	use ArrayAccessible;

	public array $items = [];

	public function __construct()
	{
		foreach( request( 'field', []) as $key => $value )
		{
			$this->items[] = new Field( $key, $value );
		}
	}

	public function apply( $model )
	{
		foreach( $this->items as $item )
		{
			if( ! $item->forRelation())
			{
				$item->apply( $model );
			}
		}
	}
}
