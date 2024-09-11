<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\RelationHandler;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Tests\Mocks\Third;
use Maestro\Accounts\Support\Concerns\AccountRelationship;
use Maestro\Accounts\Support\Concerns\RetrievesClassName;

class ParentsTest extends TestCase
{
    use AccountRelationship,        
        RetrievesClassName;

    public function testGetParentByAccountable()
    {
        list($parent, $child) = $this->makeRelation();

        $collection = $this->relation()->parents($child);  
              
        $found = $collection->first(); 
                
        $this->assertCount(1, $collection);
        $this->assertAccountable($parent, $found);
    }

    public function testGetParentByAccountableUsingToken()
    {
        list($parent, $child) = $this->makeRelation();
        
        $third = $this->makeMock(true, Third::class);
        
        $this->relation()->relate($child, $third);

        $collection = $this->relation()->parents($child); 
        $fromThird  = $this->relation()->parents($child, $third->token());
        $fromParent = $this->relation()->parents($child, $parent->token());

        $this->assertCount(1, $fromThird);
        $this->assertCount(1, $fromParent);
        $this->assertCount(2, $collection);

        $this->assertAccountable($third, $fromThird->first());
        $this->assertAccountable($parent, $fromParent->first());
    }

    private function assertAccountable($expected, $actual)
    {               
        $class = $this->getClassName($expected);

        $this->assertInstanceOf($class, $actual);
        $this->assertEquals($expected->token(), $actual->token());
    }
}