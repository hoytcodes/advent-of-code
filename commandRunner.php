<?php

require_once 'src\ReportRepair.php';
require_once 'src\PasswordPhilosophy.php';
require_once 'src\TobogganTrajectory.php';

array_shift($argv);

foreach($argv as $arg) {
  switch($arg) {
    case 'day-01':
      $class = new ReportRepair();
      $class->generateAnswer();
      break;
    case 'day-02':
        $class = new PasswordPhilosophy();
        $class->generateAnswer();
        break;
    case 'day-03':
        $class = new TobogganTrajectory();
        $class->generateAnswer();
        break;
    default:
      print "Command not recognised" . PHP_EOL;
      break;
  }
}
