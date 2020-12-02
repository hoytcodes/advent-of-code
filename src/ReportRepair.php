<?php

class ReportRepair {
  const REPORT_SUM = 2020;

  private function readFile() {
    $filePath = 'input/day-01.txt';

    $input = file($filePath, FILE_IGNORE_NEW_LINES);
    $parsedInput = [];

    foreach($input as $number) {
      $parsedInput[] = intval($number);
    }

    return $parsedInput;
  }

  public function findReportSum($input) {
    $addends = [];

    foreach ($input as $firstNumber) {
      foreach ($input as $secondNumber) {
        if (($firstNumber + $secondNumber) == self::REPORT_SUM) {
          array_push($addends, $firstNumber, $secondNumber);
          break 2;
        }
      }
    }

    return $addends;
  }

  public function multiplyEntries($input) {
    extract($input, EXTR_PREFIX_INVALID, 'number');

    return $number_0 * $number_1;
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $addends = $this->findReportSum($input);
    $answer = $this->multiplyEntries($addends);

    print "Day 1 Part 1 Answer: " . $answer;
  }
}
