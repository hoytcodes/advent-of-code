<?php

class BinaryBoarding {
  const ROW_COUNT = 128;
  const SEAT_COUNT = 8;

  private function readFile() {
    $filePath = 'input/day-05.txt';

    $input = file($filePath, FILE_IGNORE_NEW_LINES);
    return $input;
  }

  public function frontBackPartition(string $partitionString) {
    return $this->partition(self::ROW_COUNT, 'F', 'B', $partitionString);
  }

  public function leftRightPartition(string $partitionString) {
    return $this->partition(self::SEAT_COUNT, 'L', 'R', $partitionString);
  }

  private function partition(int $count, string $lowerBoundChar, string $higherBoundChar, string $partitionString) {
    $lowerBound = 0;
    $higherBound = $count - 1;

    for ($i=0; $i < (strlen($partitionString) - 1); $i++) {
      $currentCharacter = substr($partitionString, $i, 1);
      $halfBound = (($higherBound - $lowerBound) + 1) / 2;

      if($currentCharacter == $lowerBoundChar) {
        $higherBound -= $halfBound;
      } else if($currentCharacter == $higherBoundChar) {
        $lowerBound += $halfBound;
      }
    }

    $finalCharacter = substr($partitionString, -1);

    return $finalCharacter == $lowerBoundChar ? $lowerBound : $higherBound;
  }

  public function getSeatId(string $input) {
    $rowString = substr($input, 0, 7);
    $seatString = substr($input, -3);

    $rowNumber = $this->frontBackPartition($rowString);
    $seatNumber = $this->leftRightPartition($seatString);

    return ($rowNumber * 8) + $seatNumber;
  }

  public function findMissingSeat(array $seatIds) {
    sort($seatIds, SORT_NUMERIC);
    $missingSeat = 0;

    foreach ($seatIds as $seat) {
      for ($i=0; $i < count($seatIds); $i++) {
        $idDifference = $seatIds[$i] - $seat;
        if($idDifference == 2 && !in_array($seat + 1, $seatIds)) {
          $missingSeat = $seat + 1;
          break 2;
        }
      }
    }

    return $missingSeat;
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $seatIds = [];

    foreach ($input as $seat) {
      $seatIds[] = $this->getSeatId($seat);
    }

    print "Day 5 Part 1 Answer: " . max($seatIds) . PHP_EOL;
    print "Day 5 Part 2 Answer: " . $this->findMissingSeat($seatIds) . PHP_EOL;
  }
}
