<?php

class NodeSQLLiteral extends Node
{
	public $value;
	
	public function __construct($value)
	{
		$this->value = $value;
	}
	
	// Expressions
	public function count($distinct = false)
	{
		return new NodeFunctionCount($this, $distinct);
	}
	
	public function sum()
	{
		return new NodeFunctionSum($this, new NodeSQLLiteral('sum_id'));
	}
	
	public function maximum()
	{
		return new NodeFunctionMaximum($this, new NodeSQLLiteral('maximum'));
	}

	public function minimum()
	{
		return new NodeFunctionMinimum($this, new NodeSQLLiteral('minimum'));
	}
	
	public function average()
	{
		return new NodeFunctionAverage($this, new NodeSQLLiteral('average'));
	}
	
	// Predictions
	public function not_eq($other)
	{
		return new NodeNotEqual($this, $other);
	}
	
	public function not_eq_any($others)
	{
		return $this->grouping_any('not_eq', $others);
	}
	
	public function not_eq_all($others)
	{
		return $this->grouping_all('not_eq', $others);
	}
	
	public function eq($other)
	{
		return new NodeBinaryEquality($this, $other);
	}
	
	public function eq_any($others)
	{
		return $this->grouping_any('eq', $others);
	}
	
	public function eq_all($others)
	{
		return $this->grouping_all('eq', $others);
	}
	
	public function in($other)
	{
		return new NodeIn($this, $other);
	}
	
	public function in_any($others)
	{
		return $this->grouping_any('in', $others);
	}
	
	public function in_all($others)
	{
		return $this->grouping_all('in', $others);
	}
	
	public function not_in($other)
	{
		return new NodeNotIn($this, $other);
	}
	
	public function not_in_any($others)
	{
		return $this->grouping_any('not_in', $others);
	}
	
	public function not_in_all($others)
	{
		return $this->grouping_all('not_in', $others);
	}
	
	public function matches($other)
	{
		return new NodeMatches($this, $other);
	}
	
	public function match_any($others)
	{
		return $this->grouping_any('matches', $others);
	}
	
	public function match_all($others)
	{
		return $this->grouping_all('matches', $others);
	}
	
	public function does_not_match($other)
	{
		return new NodeDoesNotMatch($this, $other);
	}
	
	public function does_not_match_any($others)
	{
		return $this->grouping_any('does_not_match', $others);
	}
	
	public function does_not_match_all($others)
	{
		return $this->grouping_all('does_not_match', $others);
	}
	
	public function gteg($other)
	{
		return new NodeGreaterThanOrEqual($this, $other);
	}
	
	public function gteg_any($others)
	{
		return $this->grouping_any('gteg', $others);
	}
	
	public function gteg_all($others)
	{
		return $this->grouping_all('gteg', $others);
	}
	
	public function gt($other)
	{
		return new NodeGreaterThan($this, $other);
	}
	
	public function gt_any($others)
	{
		return $this->grouping_any('gt', $others);
	}
	
	public function gt_all($others)
	{
		return $this->grouping_all('gt', $others);
	}
	
	public function lteg($other)
	{
		return new NodeLessThanOrEqual($this, $other);
	}
	
	public function lteg_any($others)
	{
		return $this->grouping_any('lteg', $others);
	}
	
	public function lteg_all($others)
	{
		return $this->grouping_all('lteg', $others);
	}
	
	public function glt($other)
	{
		return new NodeLessThan($this, $other);
	}
	
	public function glt_any($others)
	{
		return $this->grouping_any('glt', $others);
	}
	
	public function glt_all($others)
	{
		return $this->grouping_all('glt', $others);
	}

	public function asc()
	{
		return new NodeOrdering($this, NodeOrdering::ASC);
	}
	
	public function desc()
	{
		return new NodeOrdering($this, NodeOrdering::DESC);
	}
	
	public function grouping_any($method_id, $others)
	{
		$first = $this->$method_id(array_shift($others));
		
		foreach($others as $other)
		{
			$next = $this->$method_id($other);

			$first = new NodeBinaryOr($first, $next);
		}

		return new NodeGrouping($first);
	}
	
	public function grouping_all($method_id, $others)
	{
		$first = $this->$method_id(array_shift($others));
		
		foreach($others as $other)
		{
			$next = $this->$method_id($other);

			$first = new NodeBinaryAnd($first, $next);
		}

		return new NodeGrouping($first);
	}
}