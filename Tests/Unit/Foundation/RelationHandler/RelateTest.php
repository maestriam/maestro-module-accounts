<?php

namespace Maestro\Accounts\Tests\Unit\Foundation\RelationHandler;

use Maestro\Accounts\Support\Concerns\AccountRelationship;
use Maestro\Accounts\Tests\TestCase;

class RelateTest extends TestCase
{
    use AccountRelationship;

    public function testSingleRelation()
    {
        $parent = $this->makeMock();
        $child  = $this->makeMock();

        $response = $this->relation()->relate($child, $parent);
        $collection = $this->relation()->all();

        $this->assertTrue($response);
        $this->assertCount(1, $collection);
    }

    public function testMultipleRelations()
    {
        $parent = $this->makeMock();
        $counter = 3;

        $children = $this->populate($counter);

        foreach($children as $child) {
            $this->relation()->relate($child, $parent);
        }

        $collection = $this->relation()->all();

        $this->assertCount($counter, $collection);
    }
}