<?php

namespace Iceylan\Restorm;

class Limit
{
	public int|null $limit;

	public function __construct()
	{
		$this->limit = request( 'limit' );
	}

	public function apply( $model )
	{
		$model->limit( $this->limit );
	}
}
