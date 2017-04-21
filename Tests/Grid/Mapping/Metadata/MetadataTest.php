<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping\Metadata;

use APY\DataGridBundle\Grid\Columns;
use APY\DataGridBundle\Grid\Column\Column;
use APY\DataGridBundle\Grid\Mapping\Metadata\Metadata;
use PHPUnit\Framework\TestCase;

class MetadataTest extends TestCase
{
    public function testFieldsGetAndSet()
    {
        $randomField = 'foo_' . rand(0, 100);

        $metadata = new Metadata();
        $metadata->setFields($randomField);

        $this->assertEquals($randomField, $metadata->getFields());
    }

    public function testFieldMappingWithoutField()
    {
        $randomFieldMapping = 'foo_' . rand(0, 100);

        $metadata = new Metadata();
        $metadata->setFieldsMappings($randomFieldMapping);

        $this->assertFalse($metadata->hasFieldMapping($randomFieldMapping));
    }

    public function testFieldMappingWithFieldAndDefaultTypeText()
    {
        $fieldRandom = 'foo_' . rand(0, 100);
        $valueRandom = 'bar_' . rand(0, 100);
        $fieldMapping = [$fieldRandom => $valueRandom];

        $metadata = new Metadata();
        $metadata->setFieldsMappings($fieldMapping);

        $this->assertTrue($metadata->hasFieldMapping($fieldRandom));
        $this->assertEquals($valueRandom, $metadata->getFieldMapping($fieldRandom));
        $this->assertEquals('text', $metadata->getFieldMappingType($fieldRandom));
    }

    public function testFieldMappingWithType()
    {
        $fieldRandom = 'foo_' . rand(0, 100);
        $valueRandom = 'bar_' . rand(0, 100);
        $fieldMapping = [
            $fieldRandom => [
                'type' => $valueRandom
            ]
        ];

        $metadata = new Metadata();
        $metadata->setFieldsMappings($fieldMapping);

        $this->assertEquals($valueRandom, $metadata->getFieldMappingType($fieldRandom));
    }

    public function testSetAndGetGroupBy()
    {
        $groupByRandom = 'groupBy_' . rand(0, 100);

        $metadata = new Metadata();
        $metadata->setGroupBy($groupByRandom);

        $this->assertEquals($groupByRandom, $metadata->getGroupBy());
    }

    public function testSetAndGetName()
    {
        $nameRandom = 'name_' . rand(0, 100);
        
        $metadata = new Metadata();
        $metadata->setName($nameRandom);

        $this->assertEquals($nameRandom, $metadata->getName());
    }

    public function testGetColumnsFromMapping()
    {
        $fieldRandom = 'foo_' . rand(0, 100);
        $valueRandom = 'bar_' . rand(0, 100);
        $fieldMapping = [
            $fieldRandom => [
                'type' => $valueRandom
            ]
        ];

        $columnsMockClone = $this->getMockForAbstractClass(Column::class);
        $columnsMockClone->__initialize($fieldMapping);

        $columnsMock = $this->createMock(Columns::class);
        $columnsMock->expects($this->once())
            ->method('hasExtensionForColumnType')
            ->with($valueRandom)
            ->willReturn(true);

        $columnsMock->expects($this->once())
            ->method('getExtensionForColumnType')
            ->with($valueRandom)
            ->willReturn($columnsMockClone);

        $metadata = new Metadata();
        $metadata->setFields(['foo' => $fieldRandom]);
        $metadata->setFieldsMappings($fieldMapping);
        $columns = $metadata->getColumnsFromMapping($columnsMock);

        $this->assertInstanceOf('\SplObjectStorage', $columns);
    }
}