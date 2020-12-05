<?php

use PHPUnit\Framework\TestCase;

require_once 'src\PassportProcessing.php';

class PassportProcessingTest extends TestCase {
  private $passportProcessing;

  public function setUp(): void {
    $this->passportProcessing = new PassportProcessing();
  }

  public function testParseInput() {
    $input = 'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
              byr:1937 iyr:2017 cid:147 hgt:183cm';

    $parsedInput = $this->passportProcessing->parseInput($input);

    $this->assertIsArray($parsedInput);
    $this->assertArrayHasKey('ecl', $parsedInput);
    $this->assertArrayHasKey('pid', $parsedInput);
    $this->assertArrayHasKey('eyr', $parsedInput);
    $this->assertArrayHasKey('hcl', $parsedInput);
    $this->assertArrayHasKey('byr', $parsedInput);
    $this->assertArrayHasKey('iyr', $parsedInput);
    $this->assertArrayHasKey('cid', $parsedInput);
    $this->assertArrayHasKey('hgt', $parsedInput);
  }

  public function testValidatepassports() {
    $passports = [
      'ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
      byr:1937 iyr:2017 cid:147 hgt:183cm',
      'iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
      hcl:#cfa07d byr:1929',
      'hcl:#ae17e1 iyr:2013
      eyr:2024
      ecl:brn pid:760753108 byr:1931
      hgt:179cm',
      'hcl:#cfa07d eyr:2025 pid:166559648
      iyr:2011 ecl:brn hgt:59in',
    ];
    $processedPassports = [];

    foreach ($passports as $passport) {
      $processedPassports[] = $parsedInput = $this->passportProcessing->parseInput($passport);
    }

    $validPassportCount = $this->passportProcessing->countValidPassports($processedPassports);
    $this->assertEquals(2, $validPassportCount);
  }
}
