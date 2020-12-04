<?php

use PHPUnit\Framework\TestCase;

require_once 'src\TobogganTrajectory.php';

class TobogganTrajectoryTest extends TestCase {
  private $tobogganTrajectory;

  public function setUp(): void {
    $this->tobogganTrajectory = new TobogganTrajectory();
  }

  public function testTreeCollisionCount() {
    $input = [
      '..##.......',
      '#...#...#..',
      '.#....#..#.',
      '..#.#...#.#',
      '.#...##..#.',
      '..#.##.....',
      '.#.#.#....#',
      '.#........#',
      '#.##...#...',
      '#...##....#',
      '.#..#...#.#'
    ];

    $treeCollisionCount = $this->tobogganTrajectory->treeCollisionCount($input);
    $this->assertEquals(7, $treeCollisionCount);
  }
}
