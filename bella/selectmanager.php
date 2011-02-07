<?php

class SelectManager extends TreeManager
{	
	public function __construct($table)
	{
		parent::__construct();

		$this->ast = new NodeSelectStatement;
		$this->from($table);
	}
	
	public function project()
	{
		$projections = func_get_args();
		
		foreach($projections as $projection)
		{
			$this->ast->projections[] = (is_object($projection)) ? $projection : new NodeSQLLiteral($projection);
		}
		
		return $this;
	}
		
	public function from($table)
	{
		if ( is_string($table) )
		{
			$this->ast->froms = new NodeSQLLiteral($table);
		}
		
		$this->ast->froms = $table;
	}
	
	public function group()
	{
		$columns = func_get_args();
	
		foreach($columns as $column)
		{
			$this->ast->groups[] = (is_object($column)) ? $column : new NodeSQLLiteral($column);
		}
	
		return $this;	
	}
	
	public function on($expressions)
	{
		
	}
	
	public function join($relation, $class)
	{
		
	}
	
	public function skip($amount)
	{
		$this->ast->offset = new NodeOffset($amount);
		return $this;
	}
	
	public function take($amount)
	{
		$this->ast->limit = $amount;
		return $this;
	}
	
	public function having($expression)
	{
		$this->ast->having = new NodeHaving($expression);
		return $this;		
	}
	
	public function where($expression)
	{
		$this->ast->wheres = $expression;
		return $this;
	}
	
	public function order()
	{
		$columns = func_get_args();

		foreach($columns as $column)
		{
			$this->ast->orders[] = (is_object($column)) ? $column : new NodeSQLLiteral($column);
		}
	
		return $this;
	}
}