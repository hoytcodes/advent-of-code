<?php

class TobogganTrajectory {
  private const TREE_MARKER = '#';

  private function readFile() {
    $filePath = 'input/day-03.txt';

    $input = file($filePath, FILE_IGNORE_NEW_LINES);

    return $input;
  }

  public function treeCollisionCount(array $input, int $xPath, int $yPath) {
    $mapWidth = strlen($input[0]) - 1;
    $mapHeight = count($input) - 1;

    $xCoordinate = 0;
    $yCoordinate = 0;

    $collisionCount = 0;

    while ($yCoordinate < $mapHeight) {
      if($xCoordinate + $xPath > $mapWidth) {
        $xCoordinate = ($xCoordinate + $xPath) - ($mapWidth) - 1;
      } else {
        $xCoordinate += $xPath;
      }

      $yCoordinate += $yPath;

      $coordinate = substr($input[$yCoordinate], $xCoordinate, 1);

      if($coordinate == self::TREE_MARKER) {
        $collisionCount += 1;
      }
    }

    return $collisionCount;
  }

  public function multipleCollisionCount(array $input, array $trajectories) {
    $treeCollisions = [];

    foreach ($trajectories as $trajectory) {
      $treeCollisions[] = $this->treeCollisionCount($input, $trajectory[0], $trajectory[1]);
    }

    return array_product($treeCollisions);
  }

  public function generateAnswer() {
    $input = $this->readFile();
    $trajectories = [
      [1, 1],
      [3, 1],
      [5, 1],
      [7, 1],
      [1, 2],
    ];

    $treeCollisionCount = $this->treeCollisionCount($input, 3, 1);
    $multipleCollision = $this->multipleCollisionCount($input, $trajectories);

    print "Day 3 Part 1 Answer: " . $treeCollisionCount . PHP_EOL;
    print "Day 3 Part 2 Answer: " . $multipleCollision . PHP_EOL;
  }
}
