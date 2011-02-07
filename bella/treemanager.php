<?php

class TreeManager
{
	protected $ast, $visitor;

	public function __construct()
	{
		$this->visitor = new SQLVisitor();
	}

	public function to_sql()
	{
		return $this->visitor->accept($this->ast);		
	}
}