<?php

namespace Iceylan\Restorm\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\Relation;

class ModelProxy
{
	public function __construct( private string|Builder|Relation|Model $model )
	{

	}

	public function __call( string $name, array $args ): ModelProxy|LengthAwarePaginator
	{
		if( $this->model instanceof Model )
		{
			if( $name == 'with' )
			{
				$this->model->load( $args[ 0 ]);
			}
			else
			{
				$this->model->{ $name }( ...$args );
			}
		}
		else if( is_string( $this->model ))
		{
			$this->model = $this->model::{ $name }( ...$args );
		}
		else if( $this->model instanceof Builder )
		{
			$result = $this->model->{ $name }( ...$args );

			if( $name == 'paginate' )
			{
				return $result;
			}
		}

		return $this;
	}

	public function get()
	{
		if( $this->model instanceof Model )
		{
			return $this->model;
		}
		else if( $this->model instanceof Builder )
		{
			return $this->model->get();
		}
	}

}
