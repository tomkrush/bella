<?php

class NodeBinaryTestCase extends UnitTestCase
{
	public function test_less_than()
	{
		$node = new NodeSQLLiteral('id');
		$lt = $node->lt(5);
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($lt);
		
		$this->assertEquals('id < 5', $result, 'should be less than left');		
	}
	
	public function test_less_than_or_equal()
	{
		$node = new NodeSQLLiteral('id');
		$lteq = $node->lteq(5);
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($lteq);
		
		$this->assertEquals('id <= 5', $result, 'should be less than or equal to left');		
	}
	
	public function test_greater_than()
	{
		$node = new NodeSQLLiteral('id');
		$gt = $node->gt(5);
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($gt);
		
		$this->assertEquals('id > 5', $result, 'should be greater than left');		
	}
	
	public function test_greater_than_or_equal()
	{
		$node = new NodeSQLLiteral('id');
		$gteq = $node->gteq(5);
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($gteq);
		
		$this->assertEquals('id >= 5', $result, 'should be greater than or equal to left');		
	}
}