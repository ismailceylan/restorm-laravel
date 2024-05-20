<?php

namespace Iceylan\Restorm;

class Paginate
{
	public ?string $mode = null;
	
	public function __construct( public Restorm $restorm )
	{
		$this->mode = request( 'paginate' );
	}

	public function apply( $model )
	{
		$map = 
		[
			'simple' => 'simplePaginate',
			'cursor' => 'cursorPaginate',
			'length-aware' => 'paginate'
		];

		if( ! array_key_exists( $this->mode, $map ))
		{
			throw new \Exception( "Invalid paginate mode: {$this->mode}" );
		}

		return $model->{ $map[ $this->mode ]}
		(
			$this->restorm->limit->limit
		);
	}
}
