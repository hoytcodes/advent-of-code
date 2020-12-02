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

  public function findReportSum(array $input, bool $extraAddend = false) {
    $addends = [];

    foreach ($input as $firstNumber) {
      foreach ($input as $secondNumber) {
        if ($extraAddend) {
          foreach ($input as $thirdNumber) {
            if (($firstNumber + $secondNumber + $thirdNumber) == self::REPORT_SUM) {
              array_push($addends, $firstNumber, $secondNumber, $thirdNumber);
              break 3;
            }
          }
        } else {
          if (($firstNumber + $secondNumber) == self::REPORT_SUM) {
            array_push($addends, $firstNumber, $secondNumber);
            break 2;
          }
        }
      }
    }

    return $addends;
  }

  public function multiplyEntries($input) {
    return array_product($input);
  }

  public function generateAnswer() {
    $input = $this->readFile();

    $partOneAddends = $this->findReportSum($input);
    $partOneAnswer = $this->multiplyEntries($partOneAddends);

    $partTwoAddends = $this->findReportSum($input, true);
    $partTwoAnswer = $this->multiplyEntries($partTwoAddends);

    print "Day 1 Part 1 Answer: " . $partOneAnswer . PHP_EOL;
    print "Day 1 Part 2 Answer: " . $partTwoAnswer . PHP_EOL;
  }
}
