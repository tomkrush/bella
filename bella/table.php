<?php

class Table implements arrayaccess
{
	public $name;
	protected $columns = array();
	protected $alias = '';
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function alias()
	{
		
	}
	
	public function from($table)
	{
		return new SelectManager($table);
	}
	
	public function join()
	{
		
	}
	
	public function group()
	{
		$args = func_get_args();
		return call_user_func_array(array($this->from($this), 'group'), $args);
	}
	
	public function order()
	{
		$args = func_get_args();
		return call_user_func_array(array($this->from($this), 'order'), $args);
	}
	
	public function where($condition)
	{
		return $this->from($this)->where($condition);
	}
	
	public function take($amount)
	{
		return $this->from($this)->take($amount);
	}
	
	public function skip($amount)
	{
		return $this->from($this)->skip($amount);
	}
	
	public function project()
	{		
		$args = func_get_args();
		return call_user_func_array(array($this->from($this), 'project'), $args);
	}
	
	public function having($condition)
	{
		return $this->from($this)->having($condition);
	}
	
	public function offsetSet($offset, $value) {}
	
	public function offsetExists($offset) {}
	
	public function offsetUnset($offset) {}
	
	public function offsetGet($offset) 
	{
		return new NodeAttribute($offset, $this);
	}
}