<?php

require_once 'src\ReportRepair.php';
require_once 'src\PasswordPhilosophy.php';
require_once 'src\TobogganTrajectory.php';
require_once 'src\PassportProcessing.php';
require_once 'src\BinaryBoarding.php';
require_once 'src\CustomCustoms.php';

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
    case 'day-04':
        $class = new PassportProcessing();
        $class->generateAnswer();
        break;
    case 'day-05':
        $class = new BinaryBoarding();
        $class->generateAnswer();
        break;
    case 'day-06':
        $class = new CustomCustoms();
        $class->generateAnswer();
        break;
    default:
      print "Command not recognised" . PHP_EOL;
      break;
  }
}
