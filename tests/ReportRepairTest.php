<?php

use PHPUnit\Framework\TestCase;

require_once 'src\ReportRepair.php';

class ReportRepairTest extends TestCase {
  private $reportRepair;

  public function setUp():void {
    $this->reportRepair = new ReportRepair();
  }

  public function testFindReportSum() {
    $testArray = [1721, 979, 366, 299, 675, 1456];
    $output = $this->reportRepair->findReportSum($testArray);

    $this->assertCount(2, $output);
    $this->assertEqualsCanonicalizing([1721, 299], $output);
  }

  public function testMultiplyEntries() {
    $testArray = [1721, 299];
    $output = $this->reportRepair->multiplyEntries($testArray);

    $this->assertEquals(514579, $output);
  }
}
