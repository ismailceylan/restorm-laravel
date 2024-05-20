<?php

namespace Iceylan\Restorm\With;

use ArrayAccess;
use Iceylan\Restorm\Restorm;
use Iceylan\Restorm\Support\ArrayAccessible;
use Iceylan\Restorm\Support\Filter;

class WithBag implements ArrayAccess
{
	use ArrayAccessible;

	public array $items = [];

	public function __construct( protected Restorm $restorm )
	{
		$withs = request( 'with' );
		$withs = $withs? explode( ',', $withs ) : [];

		foreach( $withs as $relation )
		{
			$this->items[] = new Relation( $restorm, $relation );
		}
	}

	public function apply( $model )
	{
		foreach( $this->items as $relation )
		{
			$model->with(
				$relation->target->getFullModelNS(),
				function( $builder ) use ( $relation )
				{
					$this->restorm->filters
						->getByTarget( $relation->target )
						->each( fn( Filter $filter ) =>
							$filter->apply( $builder )
						);
				}
			);
		}
	}
}
