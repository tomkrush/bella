<?php

class NodePrimitive extends Node
{
	public $value;
	
	public function __construct($value)
	{
		$this->value = $value;
	}
}