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

  public function countValidPasswords(array $passwordInput) {
    $validPasswordCount = 0;

    foreach ($passwordInput as $password) {
      if($password->isValid()) {
        $validPasswordCount += 1;
      }
    }

    return $validPasswordCount;
  }

  public function generateAnswer() {
    $input = $this->readFile();

    $validPasswordCount = $this->countValidPasswords($input);

    print "Day 2 Part 1 Answer: " . $validPasswordCount . PHP_EOL;
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

  public function isValid(): bool {
    $keyLetterCount = substr_count($this->password, $this->keyLetter);

    return $keyLetterCount >= $this->minValue && $keyLetterCount <= $this->maxValue;
  }
}
