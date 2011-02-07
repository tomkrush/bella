<?php

require 'bella/bella.php';

require 'unit/unit.php';
require 'bella/tests.php';

$suite = new UnitTestSuite;

$suite->addTestCase('NodeSQLLiteralTestCase');
$suite->addTestCase('NodeCountTestCase');
$suite->addTestCase('NodeSumTestCase');
$suite->addTestCase('NodeMaximumTestCase');
$suite->addTestCase('NodeMinimumTestCase');
$suite->addTestCase('NodeAverageTestCase');
$suite->addTestCase('TableTestCase');

$suite->run();