<?php

class Node 
{
	public function otherwise($right)
	{
		return new NodeGrouping(new NodeBinaryOr($this, $right));
	}	
	
	public function also($right)
	{
		return new NodeGrouping(new NodeBinaryAnd($this, $right));
	}
}