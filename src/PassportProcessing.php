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

  public function countValidPassports(array $passports, bool $validateData = false) {
    $validPassportCount = 0;
    $passportKeys = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

    foreach ($passports as $passport) {
      foreach ($passportKeys as $key) {
        if(!array_key_exists($key, $passport)) {
          continue 2;
        }
      }

      if($validateData) {
        if ($this->validateData($passport)) {
          $validPassportCount += 1;
        }
      } else {
        $validPassportCount += 1;
      }
    }

    return $validPassportCount;
  }

  public function validateData(array $passport) {
    return
      $this->validateByr($passport['byr']) &&
      $this->validateIyr($passport['iyr']) &&
      $this->validateEyr($passport['eyr']) &&
      $this->validateHgt($passport['hgt']) &&
      $this->validateHcl($passport['hcl']) &&
      $this->validateEcl($passport['ecl']) &&
      $this->validatePid($passport['pid']);
  }

  public function validateByr(string $byr) {
    $parsedByr = intval($byr);

    return strlen($byr) == 4 && $parsedByr >= 1920 && $parsedByr <= 2002;
  }

  public function validateIyr(string $iyr) {
    $parsedIyr = intval($iyr);

    return strlen($iyr) == 4 && $parsedIyr >= 2010 && $parsedIyr <= 2020;
  }

  public function validateEyr(string $eyr) {
    $parsedEyr = intval($eyr);

    return strlen($eyr) == 4 && $parsedEyr >= 2020 && $parsedEyr <= 2030;
  }

  public function validateHgt(string $hgt) {
    $unit = substr($hgt, -2);

    if(!($unit == 'in' || $unit == 'cm')) {
      return false;
    }

    $measure = intval(substr($hgt, 0, strlen($hgt) - 2));

    if ($unit == 'in') {
      return $measure >= 59 && $measure <= 76;
    } else {
      return $measure >= 150 && $measure <= 193;
    }
  }

  public function validateHcl(string $hcl) {
    if(substr($hcl, 0, 1) != '#' || strlen($hcl) != 7) {
      return false;
    }

    return (bool) preg_match('/([0-9]|[a-f]){6}/', substr($hcl, 1));
  }

  public function validateEcl(string $ecl) {
    $validEclList = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];

    return in_array($ecl, $validEclList);
  }

  public function validatePid(string $pid) {
    return strlen($pid) == 9 && ctype_digit($pid);
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $validPassportCount = $this->countValidPassports($input);
    $validPassportCountWithData = $this->countValidPassports($input, true);

    print "Day 4 Part 1 Answer: " . $validPassportCount . PHP_EOL;
    print "Day 4 Part 2 Answer: " . $validPassportCountWithData . PHP_EOL;
  }
}
