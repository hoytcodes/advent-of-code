<?php

class PassportProcessing {

  private function readFile() {
    $filePath = 'input/day-04.txt';

    $input = file_get_contents($filePath);
    $input = preg_split('/\s{2,}/', $input);
    $parsedInput = [];

    foreach($input as $passport) {
      $parsedInput[] = $this->parseInput($passport);
    }

    return $parsedInput;
  }

  public function parseInput(string $input) {
    $preparedString = str_replace(':', '=', $input);
    $preparedString = preg_replace("/\s/", '&', $preparedString);

    parse_str($preparedString, $parsedInput);

    return $parsedInput;
  }

  public function countValidPassports(array $passports) {
    $validPassportCount = 0;
    $passportKeys = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

    foreach ($passports as $passport) {
      foreach ($passportKeys as $key) {
        if(!array_key_exists($key, $passport)) {
          continue 2;
        }
      }

      $validPassportCount += 1;
    }

    return $validPassportCount;
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $validPassportCount = $this->countValidPassports($input);

    print "Day 4 Part 1 Answer: " . $validPassportCount . PHP_EOL;
  }
}
