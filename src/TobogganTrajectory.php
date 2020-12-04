<?php

class TobogganTrajectory {
  private const TREE_MARKER = '#';

  private function readFile() {
    $filePath = 'input/day-03.txt';

    $input = file($filePath, FILE_IGNORE_NEW_LINES);

    return $input;
  }

  public function treeCollisionCount(array $input) {
    $mapWidth = strlen($input[0]) - 1;
    $mapHeight = count($input) - 1;

    $xCoordinate = 0;
    $yCoordinate = 0;

    $collisionCount = 0;

    for ($i=0; $i < $mapHeight; $i++) {
      if($xCoordinate + 3 > $mapWidth) {
        $xCoordinate = ($xCoordinate + 3) - ($mapWidth) - 1;
      } else {
        $xCoordinate += 3;
      }

      $yCoordinate += 1;

      $coordinate = substr($input[$yCoordinate], $xCoordinate, 1);

      if($coordinate == self::TREE_MARKER) {
        $collisionCount += 1;
      }
    }

    return $collisionCount;
  }

  public function generateAnswer() {
    $input = $this->readFile();

    $treeCollisionCount = $this->treeCollisionCount($input);

    print "Day 3 Part 1 Answer: " . $treeCollisionCount . PHP_EOL;
  }
}
