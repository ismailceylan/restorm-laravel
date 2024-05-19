<?php

namespace Iceylan\Restorm\Filter;

class Filter
{
	public Target $target;
	public Conditions $conditions;

	public function __construct( string $target, string $conditions )
	{
		$this->target = new Target( $target );
		$this->conditions = new Conditions( $conditions );
	}

	public function forRelation(): bool
	{
		return $this->target->isRelation();
	}

	public function apply( $model )
	{
		$field = $this->target->field;
		$value = $this->conditions->value->value;

		if( $this->conditions->value->isMultiple())
		{
			$model->whereIn( $field, $value );
		}
		else
		{
			switch( $this->conditions->operator->name )
			{
				case 'equal':     $model->where( $field, '=',  $value ); break;
				case 'notequal':  $model->where( $field, '<>', $value ); break;
				case 'less':      $model->where( $field, '<',  $value ); break;
				case 'greater':   $model->where( $field, '>',  $value ); break;
				case 'lesseq':    $model->where( $field, '<=', $value ); break;
				case 'greatereq': $model->where( $field, '>=', $value ); break;
				case 'like':      $model->where( $field, 'like', $value ); break;
				case 'notlike':   $model->where( $field, 'not like', $value ); break;
				case 'null':      $model->whereNull( $field ); break;
				case 'notnull':   $model->whereNotNull( $field ); break;
				case 'between':   $model->whereBetween( $field, $value ); break;
				case 'notbetween':$model->whereNotBetween( $field, $value ); break;
			}
		}
	}

}
