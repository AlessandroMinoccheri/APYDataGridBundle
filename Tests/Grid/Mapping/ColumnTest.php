<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping;

use APY\DataGridBundle\Grid\Mapping\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    public function setUp()
    {
        $this->stringMetadata = 'foo_' . rand(0, 100);
    }

    public function testCanBeEmpty()
    {
        $column = new Column([]);
        $this->assertEquals([], $column->getMetadata());
        $this->assertEquals(['default'], $column->getGroups());
    }

    public function testColumnMetadataInjectedInConstructor()
    {
        $column = new Column($this->stringMetadata);
        $realMetadata = $column->getMetadata();

        $this->assertEquals(
            $this->stringMetadata,
            $realMetadata
        );
    }

    public function testCreatedWithDefaultsGroup()
    {
        $column = new Column($this->stringMetadata);

        $expectedGroups = ['default'];
        $this->assertEquals($expectedGroups, $column->getGroups());;
    }

    public function testGetMetadataWithGroups()
    {
        $randomGroups = 'groups_' . rand(10, 100);
        $expectedGroups = [$randomGroups];
        $expectedMetadata = ['groups' => $randomGroups];
        $column = new Column($expectedMetadata);

        $this->assertEquals($expectedMetadata, $column->getMetadata());
        $this->assertEquals($expectedGroups, $column->getGroups());
    }
}