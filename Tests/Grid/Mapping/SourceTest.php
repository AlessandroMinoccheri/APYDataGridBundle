<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping;

use APY\DataGridBundle\Grid\Mapping\Source;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    public function testSourceWithDefaultValue()
    {
        $expectedGroups = array('0' => 'default');
        $source = new Source([]);

        $this->assertEquals([], $source->getColumns());
        $this->assertFalse($source->hasColumns());
        $this->assertTrue($source->isFilterable());
        $this->assertTrue($source->isSortable());
        $this->assertEquals($expectedGroups, $source->getGroups());
        $this->assertEquals([], $source->getGroupBy());
    }

    public function testSourceWithMetadata()
    {
        $randomColumns = 'columns_' . rand(10, 100);
        $expectedColumns = array('0' => $randomColumns);
        $randomGroups = 'groups_' . rand(10, 100);
        $expectedGroups = array('0' => $randomGroups);
        $randomGroupsBy = 'groupBy_' . rand(10, 100);
        $expectedGroupsBy = array('0' => $randomGroupsBy);
        $filterable = false;
        $sortable = false;

        $source = new Source([
            'columns' => $randomColumns,
            'filterable' => $filterable,
            'sortable' => $sortable,
            'groups' => $randomGroups,
            'groupBy' => $randomGroupsBy
        ]);

        $this->assertEquals($expectedColumns, $source->getColumns());
        $this->assertTrue($source->hasColumns());
        $this->assertFalse($source->isFilterable());
        $this->assertFalse($source->isSortable());
        $this->assertEquals($expectedGroups, $source->getGroups());
        $this->assertEquals($expectedGroupsBy, $source->getGroupBy());
    }
}