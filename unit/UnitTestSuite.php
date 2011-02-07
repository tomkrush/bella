<?php

class UnitTestSuite
{
	private $cases = array();
	
	public function addTestCase($className)
	{
		$this->cases[] = $className;
	}
	
	public function run()
	{	
		foreach($this->cases as $testCase)
		{
			echo '<h2>'.$testCase.'</h2>';

			$time_start = _unit_micro_time();			

			$testCaseObject = new $testCase;
			$testCaseObject->run();

			$time_stop = _unit_micro_time();
			$time_overall = bcsub($time_stop, $time_start, 6);
			echo "<strong>$time_overall</strong> Seconds";
			
			echo '<br/>----';
		}
	}
}