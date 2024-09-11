<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\RelationHandler;

use Maestro\Accounts\Support\Concerns\AccountRelationship;
use Maestro\Accounts\Support\Concerns\RetrievesClassName;
use Maestro\Accounts\Tests\Mocks\Third;
use Maestro\Accounts\Tests\TestCase;

class ChildrenTest extends TestCase
{
    use AccountRelationship, 
        RetrievesClassName;

    public function testSingleChild()
    {
        list($parent, $child) = $this->makeRelation();

        $collection = $this->relation()->children($parent);

        $this->assertCount(1, $collection);
        $this->assertAccountable($child, $collection->first());
    }

    public function testMultipleChildren()
    {
        $counter = 3;
        $parent  = $this->makeMock(); 
        $children = $this->populate($counter);

        foreach($children as $child) {
            $this->relation()->relate($child, $parent);
        }

        $collection = $this->relation()->children($parent);
        $this->assertCount($counter, $collection);
    }

    public function testChildrenWithToken()
    {
        list($parent, $child) = $this->makeRelation();

        $third = $this->makeMock(true, Third::class);
        $this->relation()->relate($third, $parent);

        $collection = $this->relation()->children($parent);
        $fromChild  = $this->relation()->children($parent, $child->token()); 
        $fromThird  = $this->relation()->children($parent, $third->token()); 
        
        $this->assertCount(2, $collection);
        $this->assertCount(1, $fromChild);
        $this->assertCount(1, $fromThird);
    }

    private function assertAccountable($expected, $actual)
    {               
        $class = $this->getClassName($expected);

        $this->assertInstanceOf($class, $actual);
        $this->assertEquals($expected->token(), $actual->token());
    }
}