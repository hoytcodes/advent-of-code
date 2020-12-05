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
      $processedPassports[] = $this->passportProcessing->parseInput($passport);
    }

    $validPassportCount = $this->passportProcessing->countValidPassports($processedPassports);
    $this->assertEquals(2, $validPassportCount);
  }

  public function testValidateByr() {
    $validByr = '2002';
    $invalidByr = '2003';

    $this->assertTrue($this->passportProcessing->validateByr($validByr));
    $this->assertFalse($this->passportProcessing->validateByr($invalidByr));
  }

  public function testValidateHgt() {
    $validInHgt = '60in';
    $validCmHgt = '190cm';
    $invalidInHgt = '190in';
    $invalidHgt = '190';

    $this->assertTrue($this->passportProcessing->validateHgt($validInHgt));
    $this->assertTrue($this->passportProcessing->validateHgt($validCmHgt));
    $this->assertFalse($this->passportProcessing->validateHgt($invalidInHgt));
    $this->assertFalse($this->passportProcessing->validateHgt($invalidHgt));
  }

  public function testValidateHcl() {
    $validHcl = '#123abc';
    $invalidHclLetter = '#123abz';
    $invalidHclFormat = '123abc';

    $this->assertTrue($this->passportProcessing->validateHcl($validHcl));
    $this->assertFalse($this->passportProcessing->validateHcl($invalidHclLetter));
    $this->assertFalse($this->passportProcessing->validateHcl($invalidHclFormat));
  }

  public function testValidateEcl() {
    $validEcl = 'brn';
    $invalidEcl = 'wat';

    $this->assertTrue($this->passportProcessing->validateEcl($validEcl));
    $this->assertFalse($this->passportProcessing->validateEcl($invalidEcl));
  }

  public function testValidatePid() {
    $validPid = '000000001';
    $invalidPid = '0123456789';

    $this->assertTrue($this->passportProcessing->validatePid($validPid));
    $this->assertFalse($this->passportProcessing->validatePid($invalidPid));
  }

  public function testValidatePasswordData() {
    $invalidData = [
      'eyr:1972 cid:100
      hcl:#18171d ecl:amb hgt:170 pid:186cm iyr:2018 byr:1926',

      'iyr:2019
      hcl:#602927 eyr:1967 hgt:170cm
      ecl:grn pid:012533040 byr:1946',

      'hcl:dab227 iyr:2012
      ecl:brn hgt:182cm pid:021572410 eyr:2020 byr:1992 cid:277',

      'hgt:59cm ecl:zzz
      eyr:2038 hcl:74454a iyr:2023
      pid:3556412378 byr:2007'
    ];

    $validData = [
      'pid:087499704 hgt:74in ecl:grn iyr:2012 eyr:2030 byr:1980
      hcl:#623a2f',
      'eyr:2029 ecl:blu cid:129 byr:1989
      iyr:2014 pid:896056539 hcl:#a97842 hgt:165cm',
      'hcl:#888785
      hgt:164cm byr:2001 iyr:2015 cid:88
      pid:545766238 ecl:hzl
      eyr:2022',
      'iyr:2010 hgt:158cm hcl:#b6652a ecl:blu byr:1944 eyr:2021 pid:093154719'
    ];

    $invalidPassports = [];
    $validPassports = [];

    foreach ($invalidData as $passport) {
      $invalidPassports[] = $this->passportProcessing->parseInput($passport);
    }

    foreach ($validData as $passport) {
      $validPassports[] = $this->passportProcessing->parseInput($passport);
    }

    $countValidInvalidPassports = $this->passportProcessing->countValidPassports($invalidPassports, true);
    $countValidValidPassports = $this->passportProcessing->countValidPassports($validPassports, true);

    $this->assertEquals(0, $countValidInvalidPassports);
    $this->assertEquals(4, $countValidValidPassports);
  }
}
