<?php

namespace APY\DataGridBundle\Grid\Tests\Source;

use APY\DataGridBundle\Grid\Source\Document;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    private $documentName = 'Cms:Page';

    private $group = 'foo';

    public function testDocumentConstruct()
    {
        $this->assertAttributeEquals($this->documentName, 'documentName', $this->document);
        $this->assertAttributeEquals($this->group, 'group', $this->document);
    }

    public function testInitialise()
    {
        $self = $this;

        $this->container = $this->createMock(Container::class);
        $this->container->expects($this->any())
            ->method('get')
            ->will($this->returnCallback(function ($param) use ($self) {
                switch ($param) {
                    case 'doctrine.odm.mongodb.document_manager':
                        return $self->createMock(DocumentManager::class);
                        break;
                }
            }));

        $this->document->initialise($this->container);
    }

    public function setUp()
    {
        $this->document = new Document($this->documentName, $this->group);
    }
}