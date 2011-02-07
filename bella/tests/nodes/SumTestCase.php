<?php

class NodeSumTestCase extends UnitTestCase
{
	public function test_alias_the_sum()
	{
		$node = new NodeSQLLiteral('users.id');
		$sum = $node->sum()->is('foo');
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($sum);
		
		$this->assertEquals('SUM(users.id) AS foo', $result, 'should alias the sum');		
	}
}