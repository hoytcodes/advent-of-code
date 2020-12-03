<?php

use PHPUnit\Framework\TestCase;

require_once 'src\PasswordPhilosophy.php';

class PasswordPhilosophyTest extends TestCase {
  private $passwordPhilosophy;

  public function setUp():void {
    $this->passwordPhilosophy = new PasswordPhilosophy();
  }

  public function testParsePassword() {
    $password = '1-3 a: abcde';
    $parsedPassword = new Password($password);

    $this->assertEquals(1, $parsedPassword->getMinValue());
    $this->assertEquals(3, $parsedPassword->getMaxValue());
    $this->assertEquals('a', $parsedPassword->getKeyLetter());
    $this->assertEquals('abcde', $parsedPassword->getPassword());
  }

  public function testPasswordIsValid() {
    $validPassword = new Password('1-3 a: abcde');
    $invalidPassword = new Password('1-3 b: cdefg');

    $this->assertTrue($validPassword->isValid());
    $this->assertFalse($invalidPassword->isValid());
  }

  public function testCountValidPasswords() {
    $input = [
      new Password('1-3 a: abcde'),
      new Password('1-3 b: cdefg'),
      new Password('2-9 c: ccccccccc')
    ];

    $validPasswordCount = $this->passwordPhilosophy->countValidPasswords($input);

    $this->assertEquals(2, $validPasswordCount);
  }
}
