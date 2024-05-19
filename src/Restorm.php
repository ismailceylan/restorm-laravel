<?php

namespace Iceylan\Restorm;

use Closure;
use Iceylan\Restorm\Field\FieldBag;
use Iceylan\Restorm\Sort\SortBag;
use Iceylan\Restorm\Filter\FilterBag;
use Iceylan\Restorm\Support\ModelProxy;

class Restorm
{
	public FilterBag $filters;
	public Limit $limits;
	public SortBag $sorts;
	public FieldBag $fields;

	public function __construct()
	{
		$this->filters = new FilterBag;
		$this->limits = new Limit;
		$this->sorts = new SortBag;
		$this->fields = new FieldBag;

	}

	public function apply( mixed $model, Closure $cback = null )
	{
		$model = new ModelProxy( $model );

		$this->filters->apply( $model );
		$this->limits->apply( $model );
		$this->sorts->apply( $model );
		$this->fields->apply( $model );

		return $model->get();
	}
}
