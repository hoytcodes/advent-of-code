<?php

class PasswordPhilosophy {

  private function readFile() {
    $filePath = 'input/day-02.txt';

    $input = file($filePath, FILE_IGNORE_NEW_LINES);
    $parsedInput = [];

    foreach($input as $password) {
      $parsedInput[] = new Password($password);
    }

    return $parsedInput;
  }

  public function countValidLegacyPasswords(array $passwordInput) {
    $validPasswordCount = 0;

    foreach ($passwordInput as $password) {
      if($password->isValidLegacyPassword()) {
        $validPasswordCount += 1;
      }
    }

    return $validPasswordCount;
  }

  public function countValidPasswords(array $passwordInput) {
    $validPasswordCount = 0;

    foreach ($passwordInput as $password) {
      if($password->isValidPassword()) {
        $validPasswordCount += 1;
      }
    }

    return $validPasswordCount;
  }

  public function generateAnswer() {
    $input = $this->readFile();

    $validLegacyPasswordCount = $this->countValidLegacyPasswords($input);
    $validPasswordCount = $this->countValidPasswords($input);

    print "Day 2 Part 1 Answer: " . $validLegacyPasswordCount . PHP_EOL;
    print "Day 2 Part 2 Answer: " . $validPasswordCount . PHP_EOL;
  }
}

class Password {
  private $minValue;
  private $maxValue;
  private $keyLetter;
  private $password;

  public function __construct(string $passwordInput) {
    $properties = preg_split("/-| |: /", $passwordInput, 4);

    $this->minValue = $properties[0];
    $this->maxValue = $properties[1];
    $this->keyLetter = $properties[2];
    $this->password = $properties[3];
  }

  public function getMinValue(): int {
    return $this->minValue;
  }

  public function getMaxValue(): int {
    return $this->maxValue;
  }

  public function getKeyLetter(): string {
    return $this->keyLetter;
  }

  public function getPassword(): string {
    return $this->password;
  }

  public function isValidLegacyPassword(): bool {
    $keyLetterCount = substr_count($this->password, $this->keyLetter);

    return $keyLetterCount >= $this->minValue && $keyLetterCount <= $this->maxValue;
  }

  public function isValidPassword(): bool {
    $firstPosition = substr($this->password, $this->minValue - 1, 1);
    $secondPosition = substr($this->password, $this->maxValue - 1, 1);

    if ($firstPosition == $this->keyLetter && $secondPosition == $this->keyLetter) {
      return false;
    }

    return $firstPosition == $this->keyLetter || $secondPosition == $this->keyLetter;
  }
}
