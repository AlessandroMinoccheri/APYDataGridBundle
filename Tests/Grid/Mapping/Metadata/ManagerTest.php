<?php

namespace APY\DataGridBundle\Grid\Tests\Mapping\Metadata;

use APY\DataGridBundle\Grid\Mapping\Column;
use APY\DataGridBundle\Grid\Mapping\Driver\Annotation;
use APY\DataGridBundle\Grid\Mapping\Metadata\Manager;
use APY\DataGridBundle\Grid\Mapping\Metadata\Metadata;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\DateTime;

class ManagerTest extends TestCase
{
    public function testAddDriver()
    {
        $manager = new Manager();
        $manager->addDriver('foo', 'bar');
        $driver = $manager->getDrivers();

        $this->assertInstanceOf('\APY\DataGridBundle\Grid\Mapping\Metadata\DriverHeap', $driver);
    }

    public function testGetDriverReturnDifferentClone()
    {
        $manager = new Manager();
        $manager->addDriver('foo', 'bar');
        $driverFirstTime = $manager->getDrivers();
        $driverSecondTime = $manager->getDrivers();

        $this->assertNotSame($driverFirstTime, $driverSecondTime);
    }

    public function testWithoutDriverProvideEmptyMetadata()
    {
        $metadataExpected = new Metadata();
        $metadataExpected->setFields($cols = []);
        $metadataExpected->setFieldsMappings($mappings = []);
        $metadataExpected->setGroupBy($groupBy = []);

        $manager = new Manager();
        $metadata = $manager->getMetadata('foo', 'bar');

        $this->assertEquals($metadataExpected, $metadata);
    }

    public function testAddDriverProvideMetadata()
    {
        $classColumnExpected = ['0' => 'bar'];
        $groupByExpected = ['foo' => 'bar'];

        $metadataExpected = new Metadata();
        $metadataExpected->setFields($cols = $classColumnExpected);
        $metadataExpected->setFieldsMappings($mappings = [
            'bar' => [
                'foo' => 'foo2'
            ]
        ]);

        $metadataExpected->setGroupBy($groupBy = $groupByExpected);

        $annotationMock = $this->createMock(Annotation::class);
        $annotationMock->expects($this->once())
            ->method('getClassColumns')
            ->willReturn($classColumnExpected);

        $annotationMock->expects($this->once())
            ->method('getFieldsMetadata')
            ->willReturn($mappings);

        $annotationMock->expects($this->once())
            ->method('getGroupBy')
            ->willReturn($groupByExpected);

        $manager = new Manager();
        $manager->addDriver($annotationMock, 'bar');
        $metadata = $manager->getMetadata($annotationMock);

        $this->assertEquals($metadataExpected, $metadata);
    }
}