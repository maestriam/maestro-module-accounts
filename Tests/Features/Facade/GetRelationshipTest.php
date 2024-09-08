<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Entities\Relation;
use Maestro\Accounts\Support\Accounts;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Companies\Support\Companies;
use Maestro\Users\Support\Users;

class GetRelationshipTest extends TestCase
{
    public function testGetParents()
    {        
        list($parent, $child) = $this->createRelationship();

        $array = Accounts::account()->parents($child->account()->id);

        $expected = $array[0];
        
        $this->assertEquals($expected->id, $parent->id);
    }

    private function createRelationship()
    {
        $user1 = Users::factory()->model();
        $user2 = Users::factory()->model();

        Accounts::account()->create($user1, 'my.f4ke-user');
        Accounts::account()->create($user2, 'my.comp4ny-user');
        Accounts::account()->relate($user1, $user2);

        return [ $user2, $user1 ];
    }
}