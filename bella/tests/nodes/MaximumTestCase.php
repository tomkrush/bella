<?php

class NodeMaximumTestCase extends UnitTestCase
{
	public function test_alias_the_sum()
	{
		$node = new NodeSQLLiteral('users.id');
		$maximum = $node->maximum()->is('foo');
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($maximum);
		
		$this->assertEquals('MAXIMUM(users.id) AS foo', $result, 'should alias the maximum');		
	}
}