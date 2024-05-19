<?php

namespace Iceylan\Restorm\Sort;

use ArrayAccess;
use Iceylan\Restorm\Support\ArrayAccessible;

class SortBag implements ArrayAccess
{
	use ArrayAccessible;

	public $items = [];

	public function __construct()
	{
		foreach( request( 'sort', []) as $key => $value )
		{
			$this->items[] = new Sort( $key, $value );
		}
	}

	public function apply( $model )
	{
		foreach( $this->items as $sort )
		{
			if( ! $sort->forRelation())
			{
				$sort->apply( $model );
			}
		}
	}
}
