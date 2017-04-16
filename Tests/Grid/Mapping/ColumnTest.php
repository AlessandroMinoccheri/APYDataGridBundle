<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping;

use APY\DataGridBundle\Grid\Mapping\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    public function setUp()
    {
        $this->stringMetadata = 'foo';
        $this->arrayMetadata = ['foo' => 'bar_' . rand(0, 100)];
    }

    public function testColumnMetadataCanBeEmpty()
    {
        $column = new Column([]);
        $this->assertAttributeEmpty('metadata', $column);
        $this->assertAttributeEquals(['default'], 'groups', $column);
    }

    public function testColumnStringMetadataInjectedInConstructor()
    {
        $column = new Column($this->stringMetadata);
        $this->assertAttributeEquals($this->stringMetadata, 'metadata', $column);
    }

    public function testColumnArrayMetadataInjectedInConstructor()
    {
        $column = new Column($this->arrayMetadata);
        $this->assertAttributeEquals($this->arrayMetadata, 'metadata', $column);
    }

    public function testCreateColumn()
    {
        $groupsExpected = 'groupsFoo_' . rand(0, 100);

        $metadata = [
            'foo' => 'bar',
            'groups' => $groupsExpected
        ];

        $column = new Column($metadata);

        $this->assertAttributeEquals($metadata, 'metadata', $column);
        $this->assertAttributeEquals([$groupsExpected], 'groups', $column);
    }
}
