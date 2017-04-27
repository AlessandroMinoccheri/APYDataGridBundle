<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping\Metadata;

use APY\DataGridBundle\Grid\Mapping\Metadata\DriverHeap;
use APY\DataGridBundle\Grid\Mapping\Source;
use PHPUnit\Framework\TestCase;

class DriverHeapTest extends TestCase
{
    public function testCompareOk()
    {
        $priority = rand(0, 100);

        $driverHeap = new DriverHeap();

        $this->assertEquals(0, $driverHeap->compare($priority, $priority));
    }

    public function testPriority1MoreThanPriority2()
    {
        $priority1 = rand(100, 1000);
        $priority2 = rand(0, 100);

        $driverHeap = new DriverHeap();

        $this->assertEquals(-1, $driverHeap->compare($priority1, $priority2));
    }

    public function testPriority1LessThanPriority2()
    {
        $priority1 = rand(0, 100);
        $priority2 = rand(100, 1000);

        $driverHeap = new DriverHeap();

        $this->assertEquals(1, $driverHeap->compare($priority1, $priority2));
    }
}