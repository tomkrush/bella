<?php

class NodeGrouping extends Node
{
	public $expression;
	
	public function __construct($expression)
	{
		$this->expression = $expression;
	}
}
