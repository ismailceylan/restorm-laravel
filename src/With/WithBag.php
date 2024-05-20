<?php

namespace Iceylan\Restorm\With;

use ArrayAccess;
use Iceylan\Restorm\Restorm;
use Iceylan\Restorm\Support\BagContract;

class WithBag implements ArrayAccess
{
	use BagContract;

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
