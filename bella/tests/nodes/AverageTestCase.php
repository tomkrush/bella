<?php

class NodeAverageTestCase extends UnitTestCase
{
	public function test_alias_the_average()
	{
		$node = new NodeSQLLiteral('users.id');
		$average = $node->average()->is('foo');
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($average);
		
		$this->assertEquals('AVERAGE(users.id) AS foo', $result, 'should alias the average');		
	}
}