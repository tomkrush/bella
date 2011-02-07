<?php

class NodeMinimumTestCase extends UnitTestCase
{
	public function test_alias_the_minimum()
	{
		$node = new NodeSQLLiteral('users.id');
		$minimum = $node->minimum()->is('foo');
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($minimum);
		
		$this->assertEquals('MINIMUM(users.id) AS foo', $result, 'should alias the minimum');		
	}
}
