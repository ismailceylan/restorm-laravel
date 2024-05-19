<?php

namespace Iceylan\Restorm\Filter;

class FilterBag
{
	protected array $filters = [];
	
	public function __construct()
	{
		foreach( request( 'filter' ) as $key => $value )
		{
			$this->filters[] = new Filter( $key, $value );
		}
	}

	public function apply( $model )
	{
		foreach( $this->filters as $filter )
		{
			if( ! $filter->forRelation())
			{
				$filter->apply( $model );
			}
		}
	}

	public function getFiltersByRelationName( $relationName )
	{
		
	}
}
