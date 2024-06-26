<?php

namespace Maestro\Accounts\Tests\Features\Facade;

use Maestro\Accounts\Database\Models\Relation;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Accounts\Tests\TestCase;
use Maestro\Companies\Support\Facade\Companies;
use Maestro\Users\Support\Facade\Users;

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