<?php

namespace Iceylan\Restorm\Filter;

use ArrayAccess;
use Iceylan\Restorm\Target;
use Illuminate\Support\Collection;
use Iceylan\Restorm\Support\ArrayAccessible;

class FilterBag implements ArrayAccess
{
	use ArrayAccessible;

	protected array $items = [];
	
	public function __construct()
	{
		foreach( request( 'filter', []) as $key => $value )
		{
			$this->items[] = new Filter( $key, $value );
		}
	}

	public function apply( $model )
	{
		foreach( $this->items as $filter )
		{
			if( ! $filter->forRelation())
			{
				$filter->apply( $model );
			}
		}
	}

	public function getByTarget( Target $target ): Collection
	{
		$stack = [];

		foreach( $this->items as $filter )
		{
			if( $filter->target->models == $target->models )
			{
				$stack[] = $filter;
			}
		}

		return new Collection( $stack );
	}
}
