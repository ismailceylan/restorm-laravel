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
			$relationNS = $relation->target->getFullModelNS();
			
			$model->with( $relationNS, function( $builder ) use ( $relation )
			{
				foreach( [ 'filters', 'fields', 'sorts' ] as $target )
				{
					$this->restorm
						->{ $target }
						->getByTarget( $relation->target )
						->each( fn( $item ) =>
							$item->apply( $builder )
						);
				}
			});
		}
	}
}
