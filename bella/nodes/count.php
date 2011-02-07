<?php

class NodeFunctionCount extends NodeFunction
{
	public $distinct;
	
	public function __construct($expression, $distinct = FALSE, $alias = NULL)
	{
		parent::__construct($expression, $alias);
		$this->distinct = $distinct;
	}
}