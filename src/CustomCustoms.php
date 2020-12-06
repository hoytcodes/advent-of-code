<?php

class CustomCustoms {

  private function readFile() {
    $filePath = 'input/day-06.txt';

    $input = file_get_contents($filePath);
    $input = preg_split('/\s{2,}/', $input);

    return $input;
  }

  public function parseAnyInput(string $input) {
    return preg_replace("/\s/", '', $input);
  }

  public function parseEveryInput(string $input) {
    $splitInput = preg_split("/\n/", $input);
    $trimmedInput = [];

    foreach ($splitInput as $string) {
      if(empty($string)) {
        continue;
      }

      $trimmedInput[] = trim($string);
    }

    return $trimmedInput;
  }

  public function anyYesCount(array $input) {
    $parsedInput = [];

    foreach($input as $answers) {
      $parsedInput[] = $this->parseAnyInput($answers);
    }

    $totalCount = 0;

    foreach ($parsedInput as $answers) {
      $uniqueAnswers = array_unique(str_split($answers));
      $totalCount += count($uniqueAnswers);
    }

    return $totalCount;
  }

  public function everyYesCount(array $input) {
    $parsedInput = [];

    foreach($input as $answers) {
      $parsedInput[] = $this->parseEveryInput($answers);
    }

    $totalCount = 0;

    foreach ($parsedInput as $group) {
      $groupSize = count($group);
      $allAnswers = str_split(implode($group));

      $answerCount = array_count_values($allAnswers);

      foreach ($answerCount as $count) {
        if($count == $groupSize) {
          $totalCount += 1;
        }
      }
    }

    return $totalCount;
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $anyYesCount = $this->anyYesCount($input);
    $everyYesCount = $this->everyYesCount($input);

    print "Day 6 Part 1 Answer: " . $anyYesCount . PHP_EOL;
    print "Day 6 Part 2 Answer: " . $everyYesCount . PHP_EOL;
  }
}
