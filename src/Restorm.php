<?php

namespace Iceylan\Restorm;

use Closure;
use Iceylan\Restorm\Filter\FilterBag;
use Iceylan\Restorm\Support\ModelProxy;

class Restorm
{
	public FilterBag $filters;
	public Limit $limit;

	public function __construct()
	{
		$this->filters = new FilterBag;
		$this->limit = new Limit;
	}

	public function apply( mixed $model, Closure $cback = null )
	{
		$model = new ModelProxy( $model );

		$this->filters->apply( $model );
		$this->limit->apply( $model );

		return $model->get();
	}
}
