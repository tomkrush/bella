<?php

class NodeSelectStatement extends Node
{
	public $orders, $froms, $projections, $wheres, $groups, $having, $offset,  $limit;
	
	public function __construct()
	{
		$this->limit = NULL;
		$this->offset = NULL;
		$this->orders = array();
		$this->froms = array();
		$this->projections = array();
		$this->wheres = array();
		$this->groups = array();
		$this->having = NULL;
	}
}