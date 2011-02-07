<?php

class NodeFunction extends Node
{
	public $expression, $alias;
	
	public function __construct($expression, $alias = NULL)
	{
		$this->expression = $expression;
		$this->alias = $alias;
	}
	
	public function is($alias)
	{
		$this->alias = new NodeSQLLiteral($alias);
		return $this;
	}
}