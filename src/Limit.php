<?php

namespace Iceylan\Restorm;

class Limit
{
	public int|null $limit;

	public function __construct()
	{
		$this->limit = request( 'limit', null );
	}

	public function apply( $model )
	{
		if( $this->limit )
		{
			$model->limit( $this->limit );
		}
	}
}
