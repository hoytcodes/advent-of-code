<?php

use PHPUnit\Framework\TestCase;

require_once 'src\TobogganTrajectory.php';

class TobogganTrajectoryTest extends TestCase {
  private $tobogganTrajectory;
  private $input;

  public function setUp(): void {
    $this->tobogganTrajectory = new TobogganTrajectory();
    $this->input = [
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
  }

  public function testTreeCollisionCount() {
    $treeCollisionCount = $this->tobogganTrajectory->treeCollisionCount($this->input, 3, 1);
    $this->assertEquals(7, $treeCollisionCount);
  }

  public function testMulipleCollisionCount() {
    $trajectories = [
      [1, 1],
      [3, 1],
      [5, 1],
      [7, 1],
      [1, 2],
    ];

    $multipleCollision = $this->tobogganTrajectory->multipleCollisionCount($this->input, $trajectories);
    $this->assertEquals(336, $multipleCollision);
  }
}
