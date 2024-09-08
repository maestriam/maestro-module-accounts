<?php

namespace Maestro\Accounts\Tests\Feature\Facade;

use Maestro\Accounts\Tests\TestCase;
use Maestro\Accounts\Support\Accounts;

class FindTypeAccountTest extends TestCase
{
    public function testFindTypeByIdTest()
    {
        $type = Accounts::type()->factory()->create();
        
        $search = Accounts::type()->find($type->id);
        
        $this->assertEquals($type->name, $search->name);
    }
    
    public function testFindTypeByNameTest()
    {
        $type = Accounts::type()->factory()->create();

        $search = Accounts::type()->find($type->name);

        $this->assertEquals($type->name, $search->name);
    }

    public function testFindNull()
    {
        $search = Accounts::type()->find('not-found');

        $this->assertNull($search);
    }
}