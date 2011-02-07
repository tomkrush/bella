<?php

function _unit_micro_time() {
    $temp = explode(" ", microtime());
    return bcadd($temp[0], $temp[1], 6);
}

require_once 'UnitTestSuite.php';
require_once 'UnitTestCase.php';