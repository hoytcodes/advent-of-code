<?php

require_once 'src\ReportRepair.php';

array_shift($argv);

foreach($argv as $arg) {
  switch($arg) {
    case 'day-01':
      $class = new ReportRepair();
      $class->generateAnswer();
      break;
    default:
      print "Command not recognised" . PHP_EOL;
      break;
  }
}
