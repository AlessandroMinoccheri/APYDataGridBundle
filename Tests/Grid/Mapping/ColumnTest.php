<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping;

use APY\DataGridBundle\Grid\Mapping\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    public function testGetMetaDataAndGroupsDefault()
    {
        $expectedGroups = array('0' => 'default');
        $randomMetadata = 'foo_' . rand(100, 1000);
        $column = new Column($randomMetadata);

        $this->assertEquals($randomMetadata, $column->getMetadata());
        $this->assertEquals($expectedGroups, $column->getGroups());
    }

    public function testGetMetadataWithGroups()
    {
        $randomGroups = 'groups_' . rand(10, 100);
        $expectedGroups = array('0' => $randomGroups);
        $expectedMetadata = array('groups' => $randomGroups);
        $column = new Column($expectedMetadata);

        $this->assertEquals($expectedMetadata, $column->getMetadata());
        $this->assertEquals($expectedGroups, $column->getGroups());

    }
}