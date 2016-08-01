<?php

require dirname(__FILE__) . '/vendor/autoload.php';

require 'bella.php';

require 'unit/unit.php';
require 'tests.php';

$suite = new UnitTestSuite;

$suite->addTestCase('NodeSQLLiteralTestCase');
$suite->addTestCase('NodeCountTestCase');
$suite->addTestCase('NodeSumTestCase');
$suite->addTestCase('NodeMaximumTestCase');
$suite->addTestCase('NodeMinimumTestCase');
$suite->addTestCase('NodeAverageTestCase');
$suite->addTestCase('NodeBinaryTestCase');
$suite->addTestCase('TableTestCase');

$suite->run();