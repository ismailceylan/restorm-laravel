<?php

namespace Iceylan\Restorm;

use Closure;
use Iceylan\Restorm\Field\FieldBag;
use Iceylan\Restorm\Sort\SortBag;
use Iceylan\Restorm\Filter\FilterBag;
use Iceylan\Restorm\Support\ModelProxy;
use Iceylan\Restorm\With\WithBag;

class Restorm
{
	public FilterBag $filters;
	public Limit $limit;
	public SortBag $sorts;
	public FieldBag $fields;
	public WithBag $withs;
	public Paginate $paginate;

	public function __construct()
	{
		$this->filters = new FilterBag;
		$this->limit = new Limit;
		$this->sorts = new SortBag;
		$this->fields = new FieldBag;
		$this->withs = new WithBag( $this );
		$this->paginate = new Paginate( $this );

	}

	public function apply( mixed $model, Closure $cback = null )
	{
		$model = new ModelProxy( $model );
		
		$this->filters->apply( $model );
		$this->limit->apply( $model );
		$this->sorts->apply( $model );
		$this->fields->apply( $model );
		$this->withs->apply( $model );

		if( $this->paginate->mode )
		{
			return $this->paginate->apply( $model );
		}

		return $model->get();
	}
}
