<?php

use PHPUnit\Framework\TestCase;

require_once 'src\CustomCustoms.php';

class CustomCustomsTest extends TestCase {
  private $customCustoms;
  private $input = [
'abc',
'a
b
c',
'ab
ac',
'a
a
a
a',
'b'
  ];

  public function setUp(): void {
    $this->customCustoms = new CustomCustoms();
  }

  public function testAnyYesCount() {
    $yesCount = $this->customCustoms->anyYesCount($this->input);

    $this->assertEquals(11, $yesCount);
  }

  public function testEveryYesCount() {
    $yesCount = $this->customCustoms->everyYesCount($this->input);

    $this->assertEquals(6, $yesCount);
  }
}
