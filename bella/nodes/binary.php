<?php

class NodeBinary extends Node
{
	public $left, $right;
	
	public function __construct($left, $right)
	{
		$this->left = $left;
		$this->right = $right;
	}
}