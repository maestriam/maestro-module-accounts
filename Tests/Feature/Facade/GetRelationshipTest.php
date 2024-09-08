<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\Mocks\Entity;
use Maestro\Accounts\Tests\TestCase;

class GetRelationshipTest extends TestCase
{
    /**
     * @skip
     *
     * @return void
     */
    public function testGetParent()
    {        
        list($parent, $child) = $this->createRelationship();

        $collection = Accounts::account()->parents($child->account()->id);

        $parent = $collection->first();
        
        $this->assertInstanceOf(Entity::class, $parent);
    }

    private function createRelationship()
    {
        $child  = $this->makeMock(false);
        $parent = $this->makeMock(false);

        Accounts::account()->creator()->create($child, 'my.f4ke-user');
        Accounts::account()->creator()->create($parent, 'my.comp4ny-user');

        Accounts::account()->relate($child, $parent);

        return [ $parent, $child ];
    }
}