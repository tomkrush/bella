<?php

class TableTestCase extends UnitTestCase
{
	public function test_table_column()
	{
		$users = new Table('users');
		$column = $users['name'];
				
		$this->assertTrue($column instanceof NodeSQLLiteral, 'Column should be a sql literal');
	}
	
	public function test_table()
	{
		$users = new Table('users');
		$query =  $users->from($users);
		
		$this->assertEquals('SELECT FROM "users"', $query->to_sql(), 'should produce a statement');
	}
	
	public function test_table_where()
	{
		$users = new Table('users');
		$query =  $users->project('*')->where($users['project_id']->eq(1));
		
		$this->assertEquals('SELECT * FROM "users" WHERE "users"."project_id" = 1', $query->to_sql(), 'should produce a where statement with a project');
	}
	
	public function test_table_complex_where()
	{
		$users = new Table('users');
		$query =  $users->project('*')->where($users['project_id']->eq_any(array(1,4)));
		
		$this->assertEquals('SELECT * FROM "users" WHERE ("users"."project_id" = 1 OR "users"."project_id" = 4)', $query->to_sql(), 'should produce a statement');
	}
	
	public function test_table_where_or()
	{
		$users = new Table('users');
		$query = $users->where($users['name']->eq('bob')->otherwise($users['age']->lt(25)));
				
		$this->assertEquals('SELECT FROM "users" WHERE ("users"."name" = \'bob\' OR "users"."age" < 25)', $query->to_sql(), 'should produce a statement');
	}

	
	public function test_table_having()
	{
		$users = new Table('users');
		$query = $users->project('*')->having($users['id']->eq(10));
		
		$this->assertEquals('SELECT * FROM "users" HAVING "users"."id" = 10', $query->to_sql(), 'Should produce a having statement');
	}
	
	public function test_table_group()
	{
		$users = new Table('users');
		$query = $users->group('id');
		
		$this->assertEquals('SELECT FROM "users" GROUP BY id', $query->to_sql(), 'Should produce a group statement');
	}
	
	public function test_table_order()
	{
		$users = new Table('users');
		$query = $users->order('foo');
		
		$this->assertEquals('SELECT FROM "users" ORDER BY foo', $query->to_sql(), 'Should produce an order statement');
	}
	
	public function test_table_take()
	{
		$users = new Table('users');
		$query = $users->project('*')->take(1);
		
		$this->assertEquals('SELECT * FROM "users" LIMIT 1', $query->to_sql(), 'Should produce an limit statement');
	}
	
	public function test_table_project()
	{
		$users = new Table('users');
		$query =  $users->project('*');
		
		$this->assertEquals('SELECT * FROM "users"', $query->to_sql(), 'should produce a statement');
	}
	
	public function test_table_multiple_project()
	{
		$users = new Table('users');
		$query =  $users->project('*')->project('*');
		
		$this->assertEquals('SELECT *, * FROM "users"', $query->to_sql(), 'should produce a statement');
	}
}