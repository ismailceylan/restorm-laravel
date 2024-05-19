<?php

namespace Iceylan\Restorm\Support;

trait ArrayishBag
{
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
