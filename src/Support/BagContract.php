<?php

namespace Iceylan\Restorm\Support;

use Iceylan\Restorm\Target;
use Illuminate\Support\Collection;

trait BagContract
{
	public array $items = [];

	public function initialize( $queryStringKey, $handler )
	{
		foreach( request( $queryStringKey, []) as $key => $value )
		{
			$this->items[] = new $handler( $key, $value );
		}
	}

	public function apply( $model )
	{
		foreach( $this->items as $item )
		{
			if( ! $item->forRelation())
			{
				$item->apply( $model );
			}
		}
	}

	public function getByTarget( Target $target ): Collection
	{
		$stack = [];

		foreach( $this->items as $item )
		{
			if( $item->target->models == $target->models )
			{
				$stack[] = $item;
			}
		}

		return new Collection( $stack );
	}

	public function offsetExists( mixed $offset ): bool
	{
		return array_key_exists( $offset, $this->items );
	}

	public function offsetGet( mixed $offset ): mixed
	{
		return $this->items[ $offset ];
	}

	public function offsetSet( mixed $offset, mixed $value ): void
	{
		$this->items[ $offset ] = $value;
	}

	public function offsetUnset( mixed $offset ): void
	{
		unset( $this->items[ $offset ]);
	}
}
