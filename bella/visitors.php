<?php

interface Visitor {}

class SQLVisitor implements Visitor 
{
	public function accept(Node $node) 
	{
		return $this->visit($node);
	}
	
	protected function visit($node)
	{
		if ( is_string($node) )
		{
			$node = new NodeString($node);
		}
		else if ( is_integer($node) )
		{
			$node = new NodeNumber($node);
		}
		
		$method = 'visit'.str_replace('Node', '', get_class($node));
		return $this->$method($node);
	}
	
	public function visitSQLLiteral(Node $node)
	{
		return $node->value;
	}
	
	public function visitFunctionCount(NodeFunctionCount $node)
	{
		$distinct = $node->distinct ? "DISTINCT " : "";

		$alias = $node->alias ? $this->visit($node->alias) : NULL;
		$alias = $alias ? " AS {$alias}" : "";

		$name = $this->visit($node->expression);
		
		return "COUNT({$distinct}{$name}){$alias}";
	}
	
	public function visitFunctionSum(NodeFunctionSum $node)
	{
		$alias = $node->alias ? $this->visit($node->alias) : NULL;
		$alias = $alias ? " AS {$alias}" : "";
		$name = $this->visit($node->expression);
		
		return "SUM({$name}){$alias}";
	}
	
	public function visitFunctionMaximum(NodeFunctionMaximum $node)
	{
		$alias = $node->alias ? $this->visit($node->alias) : NULL;
		$alias = $alias ? " AS {$alias}" : "";
		$name = $this->visit($node->expression);
		
		return "MAXIMUM({$name}){$alias}";
	}
	
	public function visitFunctionMinimum(NodeFunctionMinimum $node)
	{
		$alias = $node->alias ? $this->visit($node->alias) : NULL;
		$alias = $alias ? " AS {$alias}" : "";
		$name = $this->visit($node->expression);
		
		return "MINIMUM({$name}){$alias}";
	}
	
	public function visitFunctionAverage(NodeFunctionAverage $node)
	{
		$alias = $node->alias ? $this->visit($node->alias) : NULL;
		$alias = $alias ? " AS {$alias}" : "";
		$name = $this->visit($node->expression);
		
		return "AVERAGE({$name}){$alias}";
	}	
	
	public function visitBinaryOr(NodeBinaryOr $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} OR {$right}";
	}
	
	public function visitBinaryAnd(NodeBinaryAnd $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} AND {$right}";
	}
	
	public function visitBinaryLessThan(NodeBinaryLessThan $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} < {$right}";
	}
	
	public function visitBinaryLessThanOrEqual(NodeBinaryLessThanOrEqual $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} <= {$right}";
	}
	
	public function visitBinaryGreaterThan(NodeBinaryGreaterThan $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} > {$right}";
	}
	
	public function visitBinaryGreaterThanOrEqual(NodeBinaryGreaterThanOrEqual $node)
	{
  	$left = $this->visit($node->left);
  	$right = $this->visit($node->right);

		return "{$left} >= {$right}";
	}
	
	public function visitGrouping(NodeGrouping $node)
	{
  	$expression = $this->visit($node->expression);

		return "({$expression})";
	}	

	public function visitString(NodeString $node)
	{
		return $node->value;
	}
	
	public function visitNumber(NodeNumber $node)
	{
		return $node->value;
	}
	
	public function visitHaving(NodeHaving $having)
	{
		$expression = $this->visit($having->expression);
		
		return " HAVING {$expression}";
	}
	
	public function visitSelectStatement(NodeSelectStatement $node)
	{
		$from_sql = "";
		if ( $froms = $node->froms)
		{
			$from = $this->visit($node->froms);
			
			$from_sql = " FROM {$from}";
		}

		$projections_sql = "";
		if ( $projections = $node->projections )
		{
			$projections_sql .= " ";

			$segments = array();
			foreach($projections as $projection)
			{
				$segments[] = $this->visit($projection);
			}
			
			$projections_sql .= implode(', ', $segments);
		}

		$group_sql = "";
		if ( $groups = $node->groups )
		{
			$group_sql .= " GROUP BY ";

			$segments = array();
			foreach($groups as $group)
			{
				$segments[] = $this->visit($group);
			}
			
			$group_sql .= implode(', ', $segments);
		}

		$where_sql = "";
		if ( $node->wheres)
		{
			$expression = $this->visit($node->wheres);
			$where_sql = " WHERE {$expression}";
		}
		
		$having_sql = "";
		if ( $node->having )
		{
			$having_sql = $this->visit($node->having);
		}
		
		$order_sql = "";
		if ( $orders = $node->orders )
		{
			$order_sql .= " ORDER BY ";

			$segments = array();
			foreach($orders as $order)
			{
				$segments[] = $this->visit($order);
			}
			
			$order_sql .= implode(', ', $segments);
		}
		
		$limit_sql = "";
		if ( $limit = $node->limit )
		{
			$limit_sql = " LIMIT {$limit}";
		}
		
		return "SELECT{$projections_sql}{$from_sql}{$where_sql}{$group_sql}{$having_sql}{$order_sql}{$limit_sql}";
	}
	
	public function visitBinaryEquality(NodeBinaryEquality $node)
	{
		$left = $this->visit($node->left);
		$right = $this->visit($node->right);
		
		if ( $right )
		{
			return "{$left} = {$right}";
		}
		else
		{
			return "{$left} IS NULL";
		}
	}
}