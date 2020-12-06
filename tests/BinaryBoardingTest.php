<?php

use PHPUnit\Framework\TestCase;

require_once 'src\BinaryBoarding.php';

class BinaryBoardingTest extends TestCase {
  private $binaryBoarding;

  public function setUp(): void {
    $this->binaryBoarding = new BinaryBoarding();
  }

  public function testFrontBackPartitioning() {
    $input = 'FBFBBFF';
    $rowNumber = $this->binaryBoarding->frontBackPartition($input);

    $this->assertEquals(44, $rowNumber);
  }

  public function testLeftRightPartitioning() {
    $input = 'RLR';
    $seatNumber = $this->binaryBoarding->leftRightPartition($input);

    $this->assertEquals(5, $seatNumber);
  }

  public function testGetSeatId() {
    $inputOne = 'BFFFBBFRRR';
    $inputTwo = 'FFFBBBFRRR';
    $inputThree = 'BBFFBBFRLL';

    $this->assertEquals(567, $this->binaryBoarding->getSeatId($inputOne));
    $this->assertEquals(119, $this->binaryBoarding->getSeatId($inputTwo));
    $this->assertEquals(820, $this->binaryBoarding->getSeatId($inputThree));
  }
}
