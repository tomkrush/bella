<?php

class NodeCountTestCase extends UnitTestCase
{
	public function test_literal_alias_count()
	{
		$node = new NodeSQLLiteral('users.id');
		$count = $node->count(FALSE)->is('foo');
		
		$visitor = new SQLVisitor();
		$result = $visitor->accept($count);
		
		$this->assertEquals('COUNT(users.id) AS foo', $result, 'should alias the count');
	}
}